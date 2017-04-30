<?php

namespace AffiliTest;

require_once 'vendor/autoload.php';

use CurlX;

class APIMulti extends API {

    function __construct($apiKey = null, $concurrency = 10, $cookiesFile = API::COOKIE_PATH) {
        parent::__construct($apiKey, $concurrency, $cookiesFile);
        $this->agent = new CurlX\Agent($concurrency);
        $this->agent->options = [
            CURLOPT_COOKIEJAR => $this->cookiesFile,
            CURLOPT_COOKIEFILE => $this->cookiesFile,
            CURLOPT_POST => 1,
            CURLOPT_HTTPHEADER => [
              'Authorization: AT-API '. $this->apiKey,
            ]
        ];
    }

    function queueTest($url, $country, $device, callable $testCallback) {
        $request = $this->agent->newRequest(API::ENDPOINTS['main'] . API::ENDPOINTS['test']);
        $request->post_data = [
            'url'       => $url,
            'country'   => $country,
            'device'    => $device
        ];
        $request->addListener($testCallback);
    }

    function queueCompareToPreview($url, $country, $device, $previewURL, callable $compareCallback) {
        $request = $this->agent->newRequest(API::ENDPOINTS['main'] . API::ENDPOINTS['compareToPreview']);
        $request->post_data = [
            'url'           => $url,
            'country'       => $country,
            'device'        => $device,
            'previewURL'    => $previewURL
        ];
        $request->addListener($compareCallback);
    }

    function execute() {
        return $this->agent->execute();
    }
}
