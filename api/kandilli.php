<?php
require_once __DIR__ . '/../config/security.php';

error_reporting(E_ALL);
ini_set('display_errors', 0);
ini_set('log_errors', 1);

Security::secureHeaders();
Security::scanRequest();

if (!headers_sent()) {
    header('Content-Type: application/json');
    header('Access-Control-Allow-Origin: *');
    header('Access-Control-Allow-Methods: GET');
}

$ip = Security::getClientIP();

if (Security::isBlocked($ip)) {
    http_response_code(403);
    die(json_encode(['error' => true, 'message' => 'Access denied. IP blocked.']));
}

Security::checkRateLimit(30, 60);

$debug = false;
if (isset($_GET['debug'])) {
    $debugParam = Security::sanitizeInput($_GET['debug'], 'alphanumeric');
    $debug = ($debugParam === '1' || strtolower($debugParam) === 'true');
}

$cacheDir = __DIR__ . '/../cache';
$cacheFile = $cacheDir . '/earthquake_data.json';
$cacheDuration = 60;

if (!is_dir($cacheDir)) {
    mkdir($cacheDir, 0755, true);
}

$forceRefresh = false;
if (isset($_GET['force_refresh'])) {
    $forceParam = Security::sanitizeInput($_GET['force_refresh'], 'alphanumeric');
    $forceRefresh = ($forceParam === '1');
}

if (!$forceRefresh && file_exists($cacheFile) && (time() - filemtime($cacheFile)) < $cacheDuration) {
    $cachedData = file_get_contents($cacheFile);
    echo $cachedData;
    exit;
}

$apiBaseUrl = 'https://api.orhanaydogdu.com.tr/deprem';
$apiUrl = $apiBaseUrl . '/kandilli/live';

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, $apiUrl);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
curl_setopt($ch, CURLOPT_TIMEOUT, 30);
curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36');
curl_setopt($ch, CURLOPT_HTTPHEADER, [
    'Accept: application/json',
    'Content-Type: application/json'
]);

$response = curl_exec($ch);
$httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
$error = curl_error($ch);
curl_close($ch);

if ($error) {
    Security::log('ERROR', "API connection error: $error - IP: $ip");
    echo json_encode([
        'error' => true,
        'message' => 'API bağlantı hatası oluştu. Lütfen daha sonra tekrar deneyin.',
        'debug' => $debug ? ['url' => $apiUrl] : null
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

if ($httpCode !== 200) {
    Security::log('ERROR', "API response error: HTTP $httpCode - IP: $ip");
    echo json_encode([
        'error' => true,
        'message' => 'API yanıt hatası oluştu. Lütfen daha sonra tekrar deneyin.',
        'debug' => $debug ? ['url' => $apiUrl, 'response_length' => strlen($response), 'response_preview' => substr($response, 0, 200)] : null
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$data = json_decode($response, true);

if (json_last_error() !== JSON_ERROR_NONE) {
    Security::log('ERROR', "JSON parse error: " . json_last_error_msg() . " - IP: $ip");
    echo json_encode([
        'error' => true,
        'message' => 'Veri işleme hatası oluştu. Lütfen daha sonra tekrar deneyin.',
        'debug' => $debug ? [
            'raw_response_preview' => substr($response, 0, 500),
            'response_length' => strlen($response),
            'json_error' => json_last_error_msg()
        ] : null
    ], JSON_UNESCAPED_UNICODE);
    exit;
}

$earthquakes = [];
$earthquakeArray = null;

if (isset($data['result']) && is_array($data['result'])) {
    $earthquakeArray = $data['result'];
} elseif (isset($data['data']) && is_array($data['data'])) {
    $earthquakeArray = $data['data'];
} elseif (isset($data['earthquakes']) && is_array($data['earthquakes'])) {
    $earthquakeArray = $data['earthquakes'];
} elseif (is_array($data) && isset($data[0]) && is_array($data[0])) {
    $earthquakeArray = $data;
}

if (!$earthquakeArray && $debug) {
    if (is_array($data)) {
        foreach ($data as $key => $value) {
            if (is_array($value) && isset($value[0]) && is_array($value[0])) {
                $earthquakeArray = $value;
                break;
            }
        }
    }
}

if ($earthquakeArray) {
    foreach ($earthquakeArray as $eq) {
        if (!is_array($eq)) continue;
        
        $lat = null;
        $lng = null;
        $magnitude = null;
        $depth = 0;
        $place = 'Bilinmeyen Konum';
        $timestamp = time();
        
        if (isset($eq['geojson']['coordinates']) && is_array($eq['geojson']['coordinates']) && count($eq['geojson']['coordinates']) >= 2) {
            $lng = floatval($eq['geojson']['coordinates'][0]);
            $lat = floatval($eq['geojson']['coordinates'][1]);
            if (count($eq['geojson']['coordinates']) >= 3) {
                $depth = floatval($eq['geojson']['coordinates'][2]);
            }
        } elseif (isset($eq['latitude']) && isset($eq['longitude'])) {
            $lat = floatval($eq['latitude']);
            $lng = floatval($eq['longitude']);
        } elseif (isset($eq['lat']) && isset($eq['lng'])) {
            $lat = floatval($eq['lat']);
            $lng = floatval($eq['lng']);
        } elseif (isset($eq['enlem']) && isset($eq['boylam'])) {
            $lat = floatval($eq['enlem']);
            $lng = floatval($eq['boylam']);
        } elseif (isset($eq['lokasyon']['latitude']) && isset($eq['lokasyon']['longitude'])) {
            $lat = floatval($eq['lokasyon']['latitude']);
            $lng = floatval($eq['lokasyon']['longitude']);
        }
        
        if (isset($eq['mag'])) {
            $magnitude = floatval($eq['mag']);
        } elseif (isset($eq['magnitude'])) {
            $magnitude = floatval($eq['magnitude']);
        } elseif (isset($eq['ml'])) {
            $magnitude = floatval($eq['ml']);
        } elseif (isset($eq['buyukluk'])) {
            $magnitude = floatval($eq['buyukluk']);
        } elseif (isset($eq['siddet'])) {
            $magnitude = floatval($eq['siddet']);
        }
        
        if (isset($eq['depth'])) {
            $depth = floatval($eq['depth']);
        } elseif (isset($eq['derinlik'])) {
            $depth = floatval($eq['derinlik']);
        } elseif (isset($eq['depth_km'])) {
            $depth = floatval($eq['depth_km']);
        } else {
            $depth = 0;
        }
        
        if (isset($eq['location'])) {
            $place = $eq['location'];
        } elseif (isset($eq['place'])) {
            $place = $eq['place'];
        } elseif (isset($eq['title'])) {
            $place = $eq['title'];
        } elseif (isset($eq['yer'])) {
            $place = $eq['yer'];
        } elseif (isset($eq['lokasyon']['name'])) {
            $place = $eq['lokasyon']['name'];
        } elseif (isset($eq['lokasyon']['title'])) {
            $place = $eq['lokasyon']['title'];
        }
        
        if (isset($eq['created_at']) && is_numeric($eq['created_at'])) {
            $timestamp = intval($eq['created_at']);
        } elseif (isset($eq['date_time'])) {
            $timestamp = is_numeric($eq['date_time']) ? intval($eq['date_time']) : strtotime($eq['date_time']);
        } elseif (isset($eq['date'])) {
            $timestamp = is_numeric($eq['date']) ? intval($eq['date']) : strtotime($eq['date']);
        } elseif (isset($eq['timestamp'])) {
            $timestamp = is_numeric($eq['timestamp']) ? intval($eq['timestamp']) : strtotime($eq['timestamp']);
        } elseif (isset($eq['time'])) {
            $timestamp = is_numeric($eq['time']) ? intval($eq['time']) : strtotime($eq['time']);
        } elseif (isset($eq['tarih'])) {
            $timestamp = is_numeric($eq['tarih']) ? intval($eq['tarih']) : strtotime($eq['tarih']);
        }
        
        if ($lat !== null && $lng !== null && $magnitude !== null && $magnitude > 0) {
            $earthquakes[] = [
                'type' => 'Feature',
                'geometry' => [
                    'type' => 'Point',
                    'coordinates' => [$lng, $lat, $depth]
                ],
                'properties' => [
                    'mag' => $magnitude,
                    'place' => $place,
                    'time' => $timestamp * 1000,
                    'depth' => $depth,
                    'source' => 'Kandilli'
                ]
            ];
        }
    }
}

$filteredEarthquakes = $earthquakes;
$geojson = [
    'type' => 'FeatureCollection',
    'features' => $filteredEarthquakes
];

$responseData = [
    'error' => false,
    'data' => $geojson,
    'count' => count($filteredEarthquakes),
    'total' => count($earthquakes),
    'cached_at' => time()
];

if ($debug) {
    $responseData['debug'] = [
        'api_url' => $apiUrl,
        'http_code' => $httpCode,
        'response_keys' => is_array($data) ? array_keys($data) : 'Not an array',
        'earthquake_array_found' => $earthquakeArray !== null,
        'earthquake_count' => $earthquakeArray ? count($earthquakeArray) : 0,
        'parsed_count' => count($earthquakes),
        'filtered_count' => count($filteredEarthquakes),
        'sample_data' => isset($earthquakeArray[0]) ? $earthquakeArray[0] : null,
        'sample_parsed' => isset($earthquakes[0]) ? $earthquakes[0] : null,
        'data_type' => gettype($data),
        'raw_response_preview' => substr($response, 0, 1000),
        'first_earthquake_keys' => isset($earthquakeArray[0]) && is_array($earthquakeArray[0]) ? array_keys($earthquakeArray[0]) : null,
        'parsing_errors' => count($earthquakeArray) > count($earthquakes) ? 'Some earthquakes could not be parsed' : null
    ];
}

echo json_encode($responseData, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);