<?php

function printJsonAsTable($jsonString) {
    // JSON-String in ein Array umwandeln
    $dataArray = json_decode($jsonString, true);

    // Fehlerbehandlung für ungültigen JSON-String
    if (json_last_error() !== JSON_ERROR_NONE) {
        echo "Ungültiger JSON-String: " . json_last_error_msg() . "\n";
        return;
    }

    // Überprüfen, ob das Array nicht leer ist
    if (empty($dataArray)) {
        echo "Das Array ist leer oder kein gültiges JSON-Array.\n";
        return;
    }

    // Extrahiere die Header (Schlüssel des ersten Elements)
    $headers = array_keys($dataArray[0]);

    // Berechne die maximale Länge für jede Spalte
    $columnWidths = array_map(function ($header) use ($dataArray) {
        $maxLength = strlen($header);
        foreach ($dataArray as $row) {
            if (isset($row[$header])) {
                $cellLength = is_array($row[$header]) ? (empty($row[$header]) ? 2 : max(array_map('strlen', $row[$header]))) : strlen($row[$header]);
            } else {
                $cellLength = 2; // Zwei Leerzeichen für leere Felder
            }
            if ($cellLength > $maxLength) {
                $maxLength = $cellLength;
            }
        }
        return $maxLength;
    }, $headers);

    // Funktion, um eine Zeile zu formatieren
    $formatRow = function ($row) use ($headers, $columnWidths) {
        // Initialisiere eine leere Liste, die die Zeilenfragmente aufnimmt
        $lines = [];

        // Gehe durch jeden Header, um die Spaltenwerte zu verarbeiten
        foreach ($headers as $header) {
            // Wenn der aktuelle Zellenwert ein Array ist, verwandle ihn in eine Zeile pro Element
            if (isset($row[$header]) && is_array($row[$header])) {
                foreach ($row[$header] as $index => $value) {
                    // Initialisiere die Zeilenfragmente, falls nötig
                    if (!isset($lines[$index])) {
                        $lines[$index] = [];
                    }
                    // Füge das aktuelle Fragment zur Zeile hinzu
                    $lines[$index][$header] = str_pad($value, $columnWidths[array_search($header, $headers)]);
                }
            } else {
                // Andernfalls füge die einzelnen Werte in eine einzige Zeile ein
                if (!isset($lines[0])) {
                    $lines[0] = [];
                }
                $value = $row[$header] ?? '  '; // Zwei Leerzeichen für leere Felder
                $lines[0][$header] = str_pad($value, $columnWidths[array_search($header, $headers)]);
            }
        }

        // Fülle leere Zellen in allen Zeilenfragmenten
        foreach ($lines as &$line) {
            foreach ($headers as $header) {
                if (!isset($line[$header])) {
                    $line[$header] = str_pad('  ', $columnWidths[array_search($header, $headers)]);
                }
            }
        }

        // Formatiere die Zeilenfragmente in eine vollständige Zeile
        return array_map(function ($line) use ($headers) {
            return "| " . implode(" | ", array_map(function ($header) use ($line) {
                    return isset($line[$header]) ? $line[$header] : str_repeat(' ', strlen($header));
                }, $headers)) . " |";
        }, $lines);
    };

    // Tabellenkopf ausgeben
    echo "+-" . implode('-+-', array_map(function ($width) {
            return str_pad('', $width, '-');
        }, $columnWidths)) . "-+\n";

    echo $formatRow(array_combine($headers, $headers))[0] . "\n";

    echo "+-" . implode('-+-', array_map(function ($width) {
            return str_pad('', $width, '-');
        }, $columnWidths)) . "-+\n";

    // Tabelleninhalt ausgeben
    foreach ($dataArray as $row) {
        $formattedRows = $formatRow($row);
        foreach ($formattedRows as $formattedRow) {
            echo $formattedRow . "\n";
        }
    }

    echo "+-" . implode('-+-', array_map(function ($width) {
            return str_pad('', $width, '-');
        }, $columnWidths)) . "-+\n";
}

function parseParameters($input) {
    $pattern = '/(\w+)=\'([^\']*)\'|(\w+)=([^ ]+)/';
    preg_match_all($pattern, $input, $matches, PREG_SET_ORDER);

    $result = [];
    foreach ($matches as $match) {
        if (isset($match[1]) && !empty($match[1])) {
            $result[$match[1]] = $match[2];
        } elseif (isset($match[3]) && !empty($match[3])) {
            $result[$match[3]] = $match[4];
        }
    }
    return $result;
}