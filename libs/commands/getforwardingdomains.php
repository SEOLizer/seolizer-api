<?php

function sapi_getforwardingdomains($para) {
    global $apiUrl,$apiVersion,$apiKey;
    $para = substr($para,0,-1);
    $requestUrl = 'https://' . $apiUrl . '/' . $apiVersion . '/getforwardingdomains/?' . $para;
    $result = slCallPostUrl($requestUrl,$apiKey,'');
    $xml = simplexml_load_string($result);
    $json = json_encode($xml);
    return json_decode($json,TRUE);
}