<?php

error_reporting(0);


if (file_exists('config/conf.php')) {
    require_once('config/conf.php');
    require_once('libs/https.php');
    require_once('libs/functionWarp.php');
    $result = sapiFunctionWarp($command, $para);
} else {
    echo("No configuration with API key has been created yet. Please complete the installation first.");
}
