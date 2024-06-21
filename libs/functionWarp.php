<?php


function sapiFunctionWarp($apiUrl,$apiVersion,$functionName,$para,$apiKey) {
    $para = substr($para,0,-1);
    $requestUrl = 'https://' . $apiUrl . '/' . $apiVersion . '/' . $functionName . '/?' . $para;
    $result = slCallPostUrl($requestUrl,$apiKey,'');
    return json_decode($result,TRUE);
}