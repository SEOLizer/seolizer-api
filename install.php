<?php

require_once('libs/https.php');

echo("-------------------------\n");
echo(" SEOLizer API-Config V0.1\n");
echo("-------------------------\n");

$url = 'api.seolizer.de';
$version = '2.1';

do {
  echo("Please make sure that the key is entered in your user account and is active.\n");
  echo("You will find the API-Keys here (https://app.seolizer.de/index.php?action=settings)\n");
  $apiKey = readline("API-Key: ");
  $fullURL = 'https://' . $url . '/' . $version . '/checkconnection/';
  $result = slCallPostUrl($fullURL,$apiKey,'');
  $xml = simplexml_load_string($result);
  $json = json_encode($xml);
  $array = json_decode($json,TRUE);
  if (is_array($array['response'])) {
    echo("API-Key not valid!\n");
  }
} while (is_array($array['response']));
echo('API-URL: ' . $url . "\n");
echo('API-Version: ' . $version . "\n");

$config  = "<?php\n";
$config .= ' $apiUrl = "' . $url . '";'."\n";
$config .= ' $apiVersion = "' . $version . '";'."\n";
$config .= ' $apiKey = "' . $apiKey . '";'."\n";

unlink('config/conf.php');
file_put_contents('config/conf.php',$config);

echo("Config saved!\n");
