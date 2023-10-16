<?php

if (!function_exists('vardump')) {
    function vardump($var)
    {
        echo '<pre style="background: #333; color: #eee;">';
        var_dump($var);
        echo '</pre>';
    }
}
