<?php

function sapi_getforwardingdomains($para) {
    global $apiUrl,$apiVersion,$apiKey;
    $para = substr($para,0,-1);
    $requestUrl = 'https://' . $apiUrl . '/' . $apiVersion . '/getforwardingdomains/?' . $para;
    $result = slCallPostUrl($requestUrl,$apiKey,'');
    return json_decode($result,TRUE);
}