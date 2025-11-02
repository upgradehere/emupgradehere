<?php
// server.php (Laravel router for PHP built-in server)
$uri = urldecode(parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH));

$publicPath = __DIR__ . '/public';
$file = $publicPath . $uri;

// If the requested resource exists as a real file (css/js/img), serve it directly.
if ($uri !== '/' && file_exists($file) && !is_dir($file)) {
    return false;
}

// Otherwise, hand everything to Laravel.
require_once $publicPath . '/index.php';
