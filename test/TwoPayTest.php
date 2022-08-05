<?php
declare(strict_types=1);

use PHPUnit\Framework\TestCase;
use Pay\SecurePay;
use Pay\TwoPay;

final class TwoPayTest extends TestCase
{

    public function testSendPay () :void
    {
        $secure_param = new SecurePay();
        $secure_param->amount = "3.2";
        $secure_param->callbackUrl = "https://pay.anycastpay.com/paid.html";
        $secure_param->currency ="USD";
        $secure_param->goodsInfo = "goods";
        $secure_param->note = "test order";
        $secure_param->description = "order test";
        $secure_param->terminal = "ONLINE";
        $secure_param->vendor = "alipay";
        $secure_param->ipnUrl = 'https://a134c93bc891e655f.awsglobalaccelerator.com:3000/2pay/notify';
        $secure_param->reference = (string)time();
        $secure_param->timeout = "120";

        $two_pay = new TwoPay("M1659370481867", "yjmsy9v5o2kam2sjsct4psc2o8y3rr5q");
        $two_pay->SecurePay($secure_param);
    }


}


