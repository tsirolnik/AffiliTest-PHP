# AffiliTest-PHP
AffiliTest's API implemented in PHP

## Installation
  * Clone this repo (`git clone https://github.com/tsirolnik/AffiliTest-PHP.git`)
  * cd into the directory (`cd AffiliTest-PHP`)
  * Install composer as instructed [here](https://getcomposer.org/download/)
  * Install the dependencies using composer(`php composer.phar install` in the current directory)
  * You're ready to go

## Examples of usage

### Testing
  * Regular testing and compare to preview - [Example code](example.php)
  * Multithreaded example (Checking multiple offers) - [Example code](example.multi.php)

### App Info
 [Example code](example.appinfo.php)

### Calls Left
 [Example code](example.callsleft.php)

### Retrieving HTTP Status codes
  In order to view the redirections' status codes, a query string is needed to be appended to the endpoints.

  Open the [API.php](affilitest/API.php#11) file and append `?codes` to the desired endpoint.

  Currently, only `/test` and `/compareToPreview` are the ones which support this feature.

  ```
  ...
  POST https://affilitest.com/api/v1/test?codes
  ...
  HTTP 200 OK
  ...
  {
    error: null,
    meta: {
      codes : [200, 301, 302]
    },
    data: ["example.com", "redirection.com", "destination.com"]
  }

  ```

 #### Supported devices
  Devices are located in [affilitest/API.php](affilitest/API.php#L122) in the class Devices.
  * Android
  * iPhone
  * iPad
  * Desktop
  * Windows Phone
  * Blackberry

  All of these devices are supported, using uppercase in the examples provided.