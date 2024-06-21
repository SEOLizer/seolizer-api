<?php

function sapiFunctionWarp($functionName,$para) {
    global $apiUrl,$apiVersion,$apiKey;
    echo("----------------------\n");
    echo($command . "\n");
    echo("----------------------\n");
    $para = substr($para,0,-1);
    $requestUrl = 'https://' . $apiUrl . '/' . $apiVersion . '/' . $functionName . '/?' . $para;
    $result = slCallPostUrl($requestUrl,$apiKey,'');
    return json_decode($result,TRUE);

}