<?php
require_once __DIR__ . '/../config/security.php';

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

Security::secureHeaders();

$ip = Security::getClientIP();
if (Security::isBlocked($ip)) {
    http_response_code(403);
    die('Access denied. IP blocked.');
}

$cacheDir = __DIR__ . '/../cache';
if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

$cacheFile = $cacheDir . '/earthquake_data.json';
$logFile = $cacheDir . '/cron_log.txt';

function logMessage($message) {
    global $logFile;
    $timestamp = date('Y-m-d H:i:s');
    file_put_contents($logFile, "[$timestamp] $message\n", FILE_APPEND);
}

try {
    $kandilliApiFile = __DIR__ . '/kandilli.php';
    
    if (file_exists($kandilliApiFile)) {
        $_GET['force_refresh'] = '1';
        $_SERVER['REQUEST_METHOD'] = 'GET';
        
        ob_start();
        include $kandilliApiFile;
        $output = ob_get_clean();
        
        $data = json_decode($output, true);
        if (json_last_error() === JSON_ERROR_NONE && isset($data['error']) && !$data['error']) {
            logMessage("Cache başarıyla güncellendi. Deprem sayısı: " . ($data['count'] ?? 0));
            echo "Başarılı: Cache güncellendi Veriler Güncellendi\n";
        } else {
            $errorMsg = json_last_error_msg();
            logMessage("HATA: API'den geçersiz yanıt alındı. JSON Error: $errorMsg");
            echo "ERROR: Geçersiz API yanıtı\n";
            exit(1);
        }
    } else {
        logMessage("HATA: kandilli.php dosyası bulunamadı: $kandilliApiFile");
        echo "ERROR: API dosyası bulunamadı\n";
        exit(1);
    }
    
} catch (Exception $e) {
    logMessage("EXCEPTION: " . $e->getMessage());
    echo "ERROR: " . $e->getMessage() . "\n";
    exit(1);
}
