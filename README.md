# AffiliTest-PHP
AffiliTest's API implemented in PHP

## Installation
  * Clone this repo (`git clone https://github.com/tsirolnik/AffiliTest-PHP.git`)
  * cd into the directory (`cd AffiliTest-PHP`)
  * Install composer as instructed [here](https://getcomposer.org/doc/00-intro.md) and [here](https://getcomposer.org/download/)
  * Install the dependencies using composer(`php composer.phar install` or `composer install`)
  * You're ready to go

## Examples of usage

### Testing
  * Regular testing and compare to preview - [Example code](example.php)
  * Multithreaded example (Checking multiple offers) - [Example code](example.multi.php)

### App Info
 [Example code](example.appinfo.php)

### Calls Left
 [Example code](example.callsleft.php)

 #### Supported devices
  Devices are located in [affilitest/API.php](affilitest/API.php#L122) in the class Devices.
  * Android
  * iPhone
  * iPad
  * Desktop
  * Windows Phone
  * Blackberry

  All of these devices are supported, using uppercase in the examples provided.