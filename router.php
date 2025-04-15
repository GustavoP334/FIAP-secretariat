<?php

if (file_exists(__DIR__ . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH))) {
    return false;
}

require_once __DIR__ . '/public/index.php';
