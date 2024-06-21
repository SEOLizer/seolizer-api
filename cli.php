<?php

error_reporting(0);

echo("-------------------------\n");
echo(" SEOLizer API-Client V0.1\n");
echo("-------------------------\n");

$command = $argv[1];
$para = '';

if ($command != '') {
    for ($i = 2; $i <= 10; $i++) {
        if ($argv[$i] != "") {
            $para .= $argv[$i] . "&";
        }
    }
    require_once('libs/api.php');
    require_once('libs/clilib.php');

    $output = "-----------------------------------------------------------\n";
    $output .= "Function: " . $result['result']['request']['action'] . "\n";
    $output .= "Credit used: " . $result['result']['request']['credits'] . "\n";
    $output .= "Primary key: " . $result['result']['response']['pointers']['attributes']['prikey'] . "\n";
    $output .= "-----------------------------------------------------------\n";
    echo($output);
    if ($result['result']['response']['pointers']['attributes']['data.pointer'] != '') {
        printJsonAsTable(json_encode($result['result']['response'][$result['result']['response']['pointers']['attributes']['data.pointer']]));
    }
} else {
    echo("no command! Exit\n");
}