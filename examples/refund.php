<?php

require './vendor/autoload.php';
use Pay\TwoPay;
$two_pay = new TwoPay("", "");

$res = $two_pay->Refund("1659943683", "1");

var_dump($res);