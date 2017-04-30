<?php

namespace AffiliTest;

require_once 'vendor/autoload.php';

use CurlX;

class API {

    const ENDPOINTS = [
        'main' => 'https://affilitest.com',
        'login' => '/user/login',
        'test' => '/api/v1/test',
        'compareToPreview' => '/api/v1/compareToPreview',
        'appInfo' => '/api/appInfo'
    ];

    const COOKIE_PATH = '/tmp/affilitestCookies';

    function __construct($apiKey = null, $concurrency = 10, $cookiesFile = API::COOKIE_PATH) {
        $this->apiKey = $apiKey;
        $this->cookiesFile = $cookiesFile;
        $this->setupCurl();
    }

    function __destruct() {
        $this->closeCurl();
    }

    public function closeCurl() {
        if($this->curl) {
            curl_close($this->curl);
        }
        $this->curl = null;
    }

    private function setupCurl() {
        $this->curl = curl_init();
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->cookiesFile);
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, $this->cookiesFile);
        curl_setopt($this->curl, CURLOPT_POST, 1);
        curl_setopt($this->curl, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($this->curl, CURLOPT_HTTPHEADER, [
            'Authorization: AT-API '. $this->apiKey
        ]);
    }

    function setCookieFile($path) {
        $this->cookiesFile = $path;
        curl_setopt($this->curl, CURLOPT_COOKIEJAR, $this->cookiesFile);
        curl_setopt($this->curl, CURLOPT_COOKIEFILE, $this->cookiesFile);
    }

    function login($email, $password) {
        return $this->post('login', [
            'email' => $email,
            'password' => $password
        ]);
    }

    function test($url, $country, $device) {
        return $this->post('test', [
            'url'       => $url,
            'country'   => $country,
            'device'    => $device
        ]);
    }

    function compareToPreview($url, $country, $device, $previewURL) {
        return $this->post('compareToPreview', [
            'url'           => $url,
            'country'       => $country,
            'device'        => $device,
            'previewURL'    => $previewURL
        ]);
    }

    private function post($endpoint, $data) {
        curl_setopt($this->curl, CURLOPT_URL, API::ENDPOINTS['main'] . API::ENDPOINTS[$endpoint]);
        curl_setopt($this->curl, CURLOPT_POSTFIELDS, http_build_query($data));
        return json_decode(curl_exec($this->curl));
    }
}


class Devices {
    const ANDROID = 'android',
          IPHONE = 'iphone',
          IPAD = 'ipad',
          DESKTOP = 'desktop',
          WINDOWS_PHONE = 'winPhone',
          BLACKBERRY = 'blackberry';
}