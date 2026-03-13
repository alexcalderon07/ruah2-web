<?php
ini_set('display_errors', 0);
require_once 'config.php';
require_once 'include/functions/header.php';

$keys = [
    'players-online',
    'accounts-created',
    'created-characters',
    'guilds-created',
    'players-online-last-24h'
];

$result = [];

foreach ($keys as $key) {
    if (function_exists('getStatistics')) {
        getStatistics($key);
        $cacheFile = getCacheFileName($key);
        if (file_exists($cacheFile)) {
            $result[$key] = file_get_contents($cacheFile);
        } else {
            $result[$key] = "0";
        }
    } else {
        $result[$key] = "0";
    }
}

header('Content-Type: application/json');
echo json_encode($result);
