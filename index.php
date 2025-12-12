<?php
require_once("config/security.php");

Security::secureHeaders();

$ip = Security::getClientIP();
if (Security::isBlocked($ip)) {
    http_response_code(403);
    die('Access denied. Your IP has been blocked due to suspicious activity.');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!Security::scanRequest()) {
        http_response_code(403);
        die('Access denied. Suspicious activity detected.');
    }
}

include("config/config.php");
define('SITE_NAME', 'Deprem Haritası');
define('SITE_DESCRIPTION', 'Türkiye genelinde gerçek zamanlı deprem verilerini görüntüleyin');
include("modules/_header.php");
include("modules/_menu.php");
include("modules/_navbar.php");

if(isset($_GET["page"])){
	$page = $_GET["page"];
	$url_parts = parse_url($page);
	if(isset($url_parts['query'])){
		parse_str($url_parts['query'], $query_params);
		$current_get = $_GET;
		$_GET = array_merge($current_get, $query_params);
		$page_name = basename($url_parts["path"]);
		$page_name = preg_replace('/[^a-z0-9_-]/i', '', $page_name);
		if (empty($page_name) || !file_exists("pages/".$page_name.".php")) {   
			include("pages/home.php");                        
		}else{
			include("pages/".$page_name.".php");
		}
	}else{
		$page_name = basename($_GET["page"]);
		$page_name = preg_replace('/[^a-z0-9_-]/i', '', $page_name);
		if (empty($page_name) || !file_exists("pages/".$page_name.".php")) {   
			include("pages/home.php");                        
		}else{
			include("pages/".$page_name.".php");
		}
	}
}else{
	include("pages/home.php");
}
include("modules/_footer.php");
