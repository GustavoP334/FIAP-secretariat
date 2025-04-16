<?php

function loadEnv(string $path)
{
    if (!file_exists($path)) {
        throw new Exception("arquivo .env não encontrado no projeto: $path");
    }

    $lines = file($path);
    
    foreach ($lines as $line) {
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        [$key, $value] = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);

        $value = trim($value, "\"'");

        putenv("$key=$value");
        $_ENV[$key] = $value;
        $_SERVER[$key] = $value;
    }
}
