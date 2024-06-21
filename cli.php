<?php

error_reporting(0);

require('libs/clilib.php');

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
        echo "command: ";
        $cmd = trim(fgets(STDIN));

        if (strtolower($cmd) == 'help') {
            displayMenu();
            $cmd = '';
        }
        if (strtolower($cmd) == 'exit') exit(0);

        $cmds = explode(" ",$cmd);
        $cmdArray = parseParameters($cmd);
        $command = $cmds[0];

        if ($command != '') {
            $para = '';
            foreach ($cmdArray as $key => $value) {
                $para .= $key . '=' . $value . '&';
            }

            require_once('libs/api.php');

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