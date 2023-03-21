<?php

error_reporting(0);

echo("-------------------------\n");
echo(" SEOLizer API-Client V0.1\n");
echo("-------------------------\n");

$command = $argv[1];
$para = '';

if ($command != '') {
    echo("API-Function: " . $command . "\n");
    for ($i = 2; $i <= 10; $i++) {
        if ($argv[$i] != "") {
            $para .= $argv[$i] . "&";
        }
    }
    require_once('libs/api.php');
    echo("Result\n");
    echo("----------------------\n");
    print_r($result);
    echo("----------------------\n");
} else {
    echo("no command! Exit\n");
}