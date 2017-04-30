<?php

  require('affilitest/API.php');

  $api = new AffiliTest\API();

  var_dump($api->login('<email>', '<password>'));

  var_dump($api->test('http://cnn.com', 'us', AffiliTest\Devices::ANDROID));
