# 2PAY PHP SDK

[2Pay Online Api](https://2pay.gitbook.io/2pay-api-docs-en/notes)


### Requirements

* CURL extension


### Installation


1. Install composer:
   ```shell notranslate position-relative overflow-auto
   $ curl -sS https://getcomposer.org/installer | php
   ```

   More info about installation on [Linux / Unix / OSX](https://getcomposer.org/doc/00-intro.md#installation-linux-unix-osx) and [Windows](https://getcomposer.org/doc/00-intro.md#installation-windows).
2. Run the Composer command to install the latest version of SDK:
   ```shell
   php composer.phar require 2pay-co/2pay-php-sdk
   ```
3. Require Composer's autoloader in your PHP script (assuming it is in the same directory where you installed Composer):
   ```shell
   require('vendor/autoload.php');
   ```


### Usage


Please see [examples](https://github.com/2pay-co/2pay-php-sdk/tree/master/examples)


### demo

```php
use Pay\TwoPay;
use Pay\SecurePay;



$secure_param = new SecurePay();
$secure_param->amount = "3.2";
$secure_param->callbackUrl = "";
$secure_param->currency ="USD";
$secure_param->goodsInfo = "";
$secure_param->note = "test order";
$secure_param->description = "order test";
$secure_param->terminal = "ONLINE";
$secure_param->vendor = "alipay";
$secure_param->ipnUrl = '';
$secure_param->reference = (string)time();
$secure_param->timeout = "120";

$two_pay = new TwoPay("merchant_no", "token");
// $res is json string
$res = $two_pay->SecurePay($secure_param);

var_dump($res);
```
