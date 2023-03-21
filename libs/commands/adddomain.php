<?php

function sapi_adddomain($para) {
    global $apiUrl,$apiVersion,$apiKey;
    $para = substr($para,0,-1);
    $requestUrl = 'https://' . $apiUrl . '/' . $apiVersion . '/adddomain/?' . $para;
    echo($requestUrl);
    $result = slCallPostUrl($requestUrl,$apiKey,'');
    $xml = simplexml_load_string($result);
    if ($xml != false) {
        $json = json_encode($xml);
        $res = json_decode($json,TRUE);
    } else {
        $res = ['result'=>$result];
    }
    return $res;
}