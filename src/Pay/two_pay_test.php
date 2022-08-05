<?php
declare(strict_types=1);
namespace Pay;

require_once './TwoPay.php';

use PHPUnit\Framework\TestCase;

class two_pay_test extends TestCase
{

    public function testSecurePay() {

        $secure_param = new SecurePay();
        $secure_param->Amount = "3.2";
        $secure_param->CallbackURL = "https://pay.anycastpay.com/paid.html";
        $secure_param->Currency ="USD";
        $secure_param->GoodsInfo = "goods";
        $secure_param->Note = "test order";
        $secure_param->Description = "order test";
        $secure_param->Terminal = "ONLINE";
        $secure_param->Vendor = "alipay";
        $secure_param->IpnURL = 'https://a134c93bc891e655f.awsglobalaccelerator.com:3000/2pay/notify';
        $secure_param->Reference = (string)time();
        $secure_param->Timeout = "120";

        $two_pay = new TwoPay("M1659370481867", "yjmsy9v5o2kam2sjsct4psc2o8y3rr5q");
        $two_pay->SecurePay($secure_param);

    }


}