<?php

function view($viewName, $data = [], $script = null, $css = null)
{
    extract($data);
    ob_start();
    require __DIR__ . "/../Views/{$viewName}.php";
    $content = ob_get_clean();
    require __DIR__ . "/../Views/app.php";
}
