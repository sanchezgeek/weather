<?php

defined('BASE_PATH') or define('BASE_PATH', __DIR__);

require_once BASE_PATH . '/vendor/autoload.php';

$dotenv = new Dotenv\Dotenv(__DIR__);
$dotenv->load();

function logToConsole($message) {
    die(PHP_EOL . $message . PHP_EOL . PHP_EOL);
}
