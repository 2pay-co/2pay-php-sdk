<?php

require './vendor/autoload.php';

use Pay\TwoPay;

$two_pay = new TwoPay("", "");
$res = $two_pay->Query("1659943683");

var_dump($res);