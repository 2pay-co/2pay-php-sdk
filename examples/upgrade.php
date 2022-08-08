<?php

require './vendor/autoload.php';
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

$two_pay = new TwoPay("", "");
$res = $two_pay->SecurePay($secure_param);

var_dump($res);