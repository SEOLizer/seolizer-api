<?php

function sapi_getforwardingdomains($para) {
    global $apiUrl,$apiVersion,$apiKey;
    $para = substr($para,0,-1);
    $requestUrl = 'https://' . $apiUrl . '/' . $apiVersion . '/getforwardingdomains/?' . $para;
    $result = slCallPostUrl($requestUrl,$apiKey,'');
    echo(".........\n");
    print_r($result);
    echo(".........\n");
    return json_decode($result,TRUE);
}