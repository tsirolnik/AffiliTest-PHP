<?php

  require('affilitest/API.php');
  require('affilitest/APIMulti.php');

  // Concurrency of 5
  $api = new AffiliTest\APIMulti(null, 5);

  var_dump($api->login('<email>', '<password>'));

  // Needed as curl saves cookies to disk only on curl_close
  $api->closeCurl();

  $urls = [
      'http://cnn.com',
      'http://yahoo.com',
      'http://google.com',
      'http://bloomberg.com',
      'http://nytimes.com'
  ];

  // A callback that will be called on every response
  function onTestFinishedCallback(CurlX\RequestInterface $request) {
    var_dump($request->response);
  }

  foreach ($urls as $url) {
       $api->queueTest($url, 'us', AffiliTest\Devices::ANDROID , 'onTestFinishedCallback');
  }

  $api->execute();


