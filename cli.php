<?php

error_reporting(0);

require_once('libs/api.php');
require_once('libs/clilib.php');


function displayMenu() {
    echo "===================================\n";
    echo "  SEOLizer CLI V1.0  \n";
    echo "===================================\n";
    echo "enter command and parameter\n";
    echo "enter 'help' to display this help\n";
    echo "exit to Exit\n";
    echo "===================================\n";
}

function main() {
    displayMenu();
    while (true) {
        echo "Enter your choice (1-3): ";
        $cmd = trim(fgets(STDIN));

        if (strtolower($cmd) == 'help') {
            displayMenu();
            $cmd = '';
        }
        if (strtolower($cmd) == 'exit') exit(0);
        if ($cmd != '') {
            for ($i = 2; $i <= 10; $i++) {
                if ($argv[$i] != "") {
                    $para .= $argv[$i] . "&";
                }
            }
            $output = "-----------------------------------------------------------\n";
            $output .= "Function: " . $result['result']['request']['action'] . "\n";
            $output .= "Credit used: " . $result['result']['request']['credits'] . "\n";
            $output .= "Primary key: " . $result['result']['response']['pointers']['attributes']['prikey'] . "\n";
            $output .= "-----------------------------------------------------------\n";
            echo($output);
            if ($result['result']['response']['pointers']['attributes']['data.pointer'] != '') {
                printJsonAsTable(json_encode($result['result']['response'][$result['result']['response']['pointers']['attributes']['data.pointer']]));
            }
        }
    }
}

// Program entry point
main();