<?php

  require('affilitest/API.php');
  require('affilitest/APIMulti.php');

  // You can replace "null" with your API key
    // Concurrency of 5
  $api = new AffiliTest\APIMulti(null, 5);

  var_dump($api->login('<email>', '<password>'));

  // Needed as curl saves cookies to disk only on curl_close
  $api->closeCurl();

  $offers = [
      ['http://tracking.com', 'us', AffiliTest\Devices::ANDROID],
      ['http://tracking.com', 'il', AffiliTest\Devices::IPHONE],
      ['http://tracking.com', 'it', AffiliTest\Devices::ANDROID],
      ['http://tracking.com', 'de', AffiliTest\Devices::IPHONE],
  ];

  // A callback that will be called on every response
  function onTestFinishedCallback(CurlX\RequestInterface $request) {
    var_dump($request->response);
  }

  foreach ($offers as $offer) {
    list($url, $country, $device) = $offer;
    // Perform a regular test
    $api->queueTest($url, $country, $device , 'onTestFinishedCallback');
  }

  foreach ($offers as $offer) {
    list($url, $country, $device) = $offer;
    // Perform a compare to preview test
    $api->queueCompareToPreview($url, $country, $device, 'http://previewURL.com', 'onTestFinishedCallback');
  }

  $api->execute();


