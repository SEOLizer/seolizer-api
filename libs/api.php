<?php

require('config/conf.php');

if (file_exists('config/conf.php')) {
    $result = sapiFunctionWarp($apiUrl,$apiVersion,$command, $para,$apiKey);
} else {
    echo("No configuration with API key has been created yet. Please complete the installation first.");
}
