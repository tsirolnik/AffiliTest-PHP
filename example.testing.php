<?php

  require('affilitest/API.php');

  $api = new AffiliTest\API();

  var_dump($api->login('<email>', '<password>'));

  var_dump($api->test('http://cnn.com', 'us', AffiliTest\Devices::ANDROID));
  var_dump($api->test('http://cnn.com', 'us', AffiliTest\Devices::IPHONE));

  // The preview can be a playstore/appstore URL or the package/app id
  $previewURL = 'com.whatsapp';
  var_dump($api->compareToPreview(
    'https://play.google.com/store/apps/details?id=com.whatsapp',
     'us',
      AffiliTest\Devices::ANDROID,
       $previewURL)
       );
