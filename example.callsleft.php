<?php

  require('affilitest/API.php');

  $api = new AffiliTest\API();

  var_dump($api->login('<email>', '<password>'));

  # Simply call this function
  var_dump($api->callsLeft());