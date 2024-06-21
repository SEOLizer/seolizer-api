<?php

require_once('../libs/clilib.php');

// Beispiel JSON-String
$jsonString = '[
    {"Name": "John Doe", "Alter": "30", "Beruf": ["Entwickler", "Berater"]},
    {"Name": "Jane Smith", "Alter": "25", "Beruf": ["Designer"]},
    {"Name": "Samantha Brown", "Alter": "28", "Beruf": ["Manager", "Coach mit einem sehr langen Titel"]},
    {"Name": "Chris", "Alter": "40", "Beruf": []}
]';

print_r($jsonString);
// Funktion aufrufen
printJsonAsTable($jsonString);

?>