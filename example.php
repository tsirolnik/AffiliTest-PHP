<?php

  require('affilitest/API.php');

  $api = new AffiliTest\API('<email>', '<password>');

  var_dump($api->login());

  var_dump($api->test('http://cnn.com', 'us', AffiliTest\Devices::ANDROID));
