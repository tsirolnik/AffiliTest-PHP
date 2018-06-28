<?php

  require('../affilitest/API.php');

  $api = new AffiliTest\API();

  var_dump($api->login('<email>', '<password>'));


    # Using Google Play Store URL
  var_dump($api->appInfo('https://play.google.com/store/apps/details?id=com.whatsapp&hl=en'));
  # Using iTunes app store URL
  var_dump($api->appInfo('https://itunes.apple.com/us/app/whatsapp-messenger/id310633997?mt=8'));


  # Using Google Play Store package name
  var_dump($api->appInfo(null, 'com.whatsapp'));


  # Calling the app info with an iTunes app store package
  # This requires specifying the country too.
  # The country is a two letter string as described by ISO 3166-alpha-2.
  # e.g - us for the United States, il for Israel, de for Germany and so on
  var_dump($api->appInfo(null, '310633997', 'us'));