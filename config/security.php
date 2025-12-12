<?php
class Security {
    private static $logFile;
    private static $rateLimitFile;
    private static $blockedIPsFile;
    
    public static function init() {
        $logDir = __DIR__ . '/../cache/security';
        if (!is_dir($logDir)) {
            mkdir($logDir, 0755, true);
        }
        
        self::$logFile = $logDir . '/security.log';
        self::$rateLimitFile = $logDir . '/rate_limit.json';
        self::$blockedIPsFile = $logDir . '/blocked_ips.json';
    }
    
    public static function getClientIP() {
        $ipKeys = ['HTTP_CF_CONNECTING_IP', 'HTTP_X_REAL_IP', 'HTTP_X_FORWARDED_FOR', 'REMOTE_ADDR'];
        foreach ($ipKeys as $key) {
            if (!empty($_SERVER[$key])) {
                $ip = $_SERVER[$key];
                if (strpos($ip, ',') !== false) {
                    $ip = explode(',', $ip)[0];
                }
                $ip = trim($ip);
                if (filter_var($ip, FILTER_VALIDATE_IP, FILTER_FLAG_NO_PRIV_RANGE | FILTER_FLAG_NO_RES_RANGE)) {
                    return $ip;
                }
            }
        }
        return $_SERVER['REMOTE_ADDR'] ?? '0.0.0.0';
    }
    
    public static function isBlocked($ip = null) {
        if ($ip === null) {
            $ip = self::getClientIP();
        }
        
        if (!file_exists(self::$blockedIPsFile)) {
            return false;
        }
        
        $blocked = json_decode(file_get_contents(self::$blockedIPsFile), true);
        if (!is_array($blocked)) {
            return false;
        }
        
        if (isset($blocked[$ip])) {
            if ($blocked[$ip]['expires'] > time()) {
                return true;
            } else {
                unset($blocked[$ip]);
                file_put_contents(self::$blockedIPsFile, json_encode($blocked));
            }
        }
        
        return false;
    }
    
    public static function blockIP($ip, $duration = 3600, $reason = 'Suspicious activity') {
        $blocked = [];
        if (file_exists(self::$blockedIPsFile)) {
            $blocked = json_decode(file_get_contents(self::$blockedIPsFile), true) ?: [];
        }
        
        $blocked[$ip] = [
            'ip' => $ip,
            'blocked_at' => time(),
            'expires' => time() + $duration,
            'reason' => $reason
        ];
        
        file_put_contents(self::$blockedIPsFile, json_encode($blocked));
        self::log('BLOCK', "IP blocked: $ip - Reason: $reason - Duration: {$duration}s");
    }
    
    public static function checkRateLimit($maxRequests = 60, $timeWindow = 60) {
        $ip = self::getClientIP();
        
        if (self::isBlocked($ip)) {
            http_response_code(429);
            die(json_encode(['error' => true, 'message' => 'Too many requests. IP temporarily blocked.']));
        }
        
        $rateLimit = [];
        if (file_exists(self::$rateLimitFile)) {
            $rateLimit = json_decode(file_get_contents(self::$rateLimitFile), true) ?: [];
        }
        
        $now = time();
        if (!isset($rateLimit[$ip])) {
            $rateLimit[$ip] = ['count' => 1, 'window_start' => $now];
        } else {
            if ($now - $rateLimit[$ip]['window_start'] > $timeWindow) {
                $rateLimit[$ip] = ['count' => 1, 'window_start' => $now];
            } else {
                $rateLimit[$ip]['count']++;
            }
        }
        
        if ($rateLimit[$ip]['count'] > $maxRequests) {
            self::blockIP($ip, 300, 'Rate limit exceeded');
            http_response_code(429);
            die(json_encode(['error' => true, 'message' => 'Rate limit exceeded. Please try again later.']));
        }
        
        file_put_contents(self::$rateLimitFile, json_encode($rateLimit));
        return true;
    }
    
    public static function sanitizeInput($input, $type = 'string') {
        if (is_array($input)) {
            return array_map(function($item) use ($type) {
                return self::sanitizeInput($item, $type);
            }, $input);
        }
        
        $input = trim($input);
        
        switch ($type) {
            case 'int':
                return filter_var($input, FILTER_SANITIZE_NUMBER_INT);
            case 'float':
                return filter_var($input, FILTER_SANITIZE_NUMBER_FLOAT, FILTER_FLAG_ALLOW_FRACTION);
            case 'email':
                return filter_var($input, FILTER_SANITIZE_EMAIL);
            case 'url':
                return filter_var($input, FILTER_SANITIZE_URL);
            case 'filename':
                return preg_replace('/[^a-zA-Z0-9._-]/', '', $input);
            case 'alphanumeric':
                return preg_replace('/[^a-zA-Z0-9]/', '', $input);
            default:
                return htmlspecialchars($input, ENT_QUOTES, 'UTF-8');
        }
    }
    
    public static function validateInput($input, $type = 'string', $minLength = 0, $maxLength = 0) {
        if (empty($input) && $minLength > 0) {
            return false;
        }
        
        switch ($type) {
            case 'int':
                return filter_var($input, FILTER_VALIDATE_INT) !== false;
            case 'float':
                return filter_var($input, FILTER_VALIDATE_FLOAT) !== false;
            case 'email':
                return filter_var($input, FILTER_VALIDATE_EMAIL) !== false;
            case 'url':
                return filter_var($input, FILTER_VALIDATE_URL) !== false;
            case 'filename':
                return preg_match('/^[a-zA-Z0-9._-]+$/', $input) && !preg_match('/\.\./', $input);
            default:
                $len = strlen($input);
                if ($minLength > 0 && $len < $minLength) return false;
                if ($maxLength > 0 && $len > $maxLength) return false;
                return true;
        }
    }
    
    public static function detectShellUpload($filename) {
        $dangerousExtensions = ['php', 'phtml', 'php3', 'php4', 'php5', 'phps', 'phar', 'asp', 'aspx', 'jsp', 'sh', 'bash', 'py', 'pl', 'rb', 'exe', 'bat', 'cmd'];
        $ext = strtolower(pathinfo($filename, PATHINFO_EXTENSION));
        
        if (in_array($ext, $dangerousExtensions)) {
            return true;
        }
        
        $dangerousPatterns = [
            '/eval\s*\(/i',
            '/base64_decode/i',
            '/shell_exec/i',
            '/system\s*\(/i',
            '/exec\s*\(/i',
            '/passthru/i',
            '/proc_open/i',
            '/popen/i',
            '/file_get_contents/i',
            '/file_put_contents/i',
            '/fwrite/i',
            '/fopen/i'
        ];
        
        if (file_exists($filename)) {
            $content = file_get_contents($filename);
            foreach ($dangerousPatterns as $pattern) {
                if (preg_match($pattern, $content)) {
                    return true;
                }
            }
        }
        
        return false;
    }
    
    public static function detectSQLInjection($input) {
        $sqlPatterns = [
            '/(\bUNION\b.*\bSELECT\b.*\bFROM\b)/i',
            '/(\bINSERT\b.*\bINTO\b.*\bVALUES\b)/i',
            '/(\bUPDATE\b.*\bSET\b.*=)/i',
            '/(\bDELETE\b.*\bFROM\b.*\bWHERE\b)/i',
            '/(\bDROP\b.*\bTABLE\b)/i',
            '/(\bEXEC\b|\bEXECUTE\b)/i',
            '/(\'\s*OR\s*\'\d+\'=\'\d+\')/i',
            '/(;\s*DROP\s+TABLE)/i',
            '/(\bUNION\b.*\bALL\b.*\bSELECT\b)/i',
            '/(\bOR\b\s+\'\d+\'\s*=\s*\'\d+\')/i'
        ];
        
        foreach ($sqlPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return true;
            }
        }
        
        return false;
    }
    
    public static function detectXSS($input) {
        $xssPatterns = [
            '/<script[^>]*>.*?<\/script>/is',
            '/<iframe[^>]*>.*?<\/iframe>/is',
            '/javascript:/i',
            '/on\w+\s*=/i',
            '/<img[^>]+src[^>]*=.*javascript:/i',
            '/<svg[^>]*onload/i',
            '/<body[^>]*onload/i'
        ];
        
        foreach ($xssPatterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return true;
            }
        }
        
        return false;
    }
    
    public static function detectPathTraversal($input) {
        $patterns = [
            '/\.\.\//',
            '/\.\.\\\\/',
            '/\.\.%2F/',
            '/\.\.%5C/',
            '/\.\.%c0%af/',
            '/\.\.%c1%9c/'
        ];
        
        foreach ($patterns as $pattern) {
            if (preg_match($pattern, $input)) {
                return true;
            }
        }
        
        return false;
    }
    
    public static function scanRequest() {
        $suspicious = false;
        $threats = [];
        $suspiciousCount = 0;
        
        foreach ($_GET as $key => $value) {
            if (is_string($value) && strlen($value) > 10) {
                if (self::detectSQLInjection($value)) {
                    $threats[] = "SQL Injection detected in GET parameter: $key";
                    $suspiciousCount++;
                }
                if (self::detectXSS($value)) {
                    $threats[] = "XSS detected in GET parameter: $key";
                    $suspiciousCount++;
                }
                if (self::detectPathTraversal($value)) {
                    $threats[] = "Path Traversal detected in GET parameter: $key";
                    $suspiciousCount++;
                }
            }
        }
        
        foreach ($_POST as $key => $value) {
            if (is_string($value)) {
                if (self::detectSQLInjection($value)) {
                    $threats[] = "SQL Injection detected in POST parameter: $key";
                    $suspiciousCount++;
                }
                if (self::detectXSS($value)) {
                    $threats[] = "XSS detected in POST parameter: $key";
                    $suspiciousCount++;
                }
                if (self::detectPathTraversal($value)) {
                    $threats[] = "Path Traversal detected in POST parameter: $key";
                    $suspiciousCount++;
                }
            }
        }
        
        if ($suspiciousCount >= 2) {
            $ip = self::getClientIP();
            self::log('THREAT', "Suspicious activity from IP: $ip - Threats: " . implode(', ', $threats));
            self::blockIP($ip, 1800, 'Suspicious activity detected');
            return false;
        }
        
        if ($suspiciousCount == 1) {
            $ip = self::getClientIP();
            self::log('WARNING', "Potential threat from IP: $ip - Threat: " . implode(', ', $threats));
        }
        
        return true;
    }
    
    public static function log($level, $message) {
        $timestamp = date('Y-m-d H:i:s');
        $ip = self::getClientIP();
        $userAgent = $_SERVER['HTTP_USER_AGENT'] ?? 'Unknown';
        $requestUri = $_SERVER['REQUEST_URI'] ?? 'Unknown';
        
        $logEntry = "[$timestamp] [$level] IP: $ip | URI: $requestUri | UA: $userAgent | Message: $message\n";
        file_put_contents(self::$logFile, $logEntry, FILE_APPEND);
        
        if (filesize(self::$logFile) > 10 * 1024 * 1024) {
            $lines = file(self::$logFile);
            $lines = array_slice($lines, -5000);
            file_put_contents(self::$logFile, implode('', $lines));
        }
    }
    
    public static function generateCSRFToken() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        if (!isset($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }
        
        return $_SESSION['csrf_token'];
    }
    
    public static function validateCSRFToken($token) {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        return isset($_SESSION['csrf_token']) && hash_equals($_SESSION['csrf_token'], $token);
    }
    
    public static function secureHeaders() {
        if (!headers_sent()) {
            header('X-Content-Type-Options: nosniff');
            header('X-Frame-Options: SAMEORIGIN');
            header('X-XSS-Protection: 1; mode=block');
            header('Referrer-Policy: strict-origin-when-cross-origin');
            header('Content-Security-Policy: default-src \'self\'; script-src \'self\' \'unsafe-inline\' https://unpkg.com https://cdnjs.cloudflare.com; style-src \'self\' \'unsafe-inline\' https://unpkg.com https://cdnjs.cloudflare.com; img-src \'self\' data: https:; font-src \'self\' https://cdnjs.cloudflare.com;');
        }
    }
}

Security::init();
