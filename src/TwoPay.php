<?php
declare(strict_types=1);
namespace Pay;

class TwoPay
{
    const Base_URL = 'https://api.2pay.co';
    const Secure_Pay = '/online/v1/secure-pay';
    const Refund = '/app-data-search/v1/refund';
    const Query = '/app-data-search/v1/tran-query';

    private string $merchant_no;
    private string $token;

    public function __construct($merchant_no,$token)
    {
        $this->merchant_no = $merchant_no;
        $this->token = $token;
    }

    /**
     * @param SecurePay $pay
     * @return void
     */
    public function SecurePay(SecurePay $pay)
    {
        $pay->merchantNo = $this->merchant_no;

        $array = json_decode(json_encode($pay), true);
        $pay->verifySign = $this->_sign($array);

        $this->post($pay);

    }

    private function post (SecurePay $pay) {

        $url = self::Base_URL . self::Secure_Pay;
        $ch = curl_init();
        $post_data = $data_string = json_encode($pay,JSON_UNESCAPED_UNICODE);

        curl_setopt($ch, CURLOPT_URL, $url);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($data_string))
        );

        if (false !== stripos($url, "https://")) { // https处理，不校验相关证书
            curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
            curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, FALSE);
        }

        $output = curl_exec($ch);
        curl_close($ch);
        //打印获得的数据
        return $output;
    }

    private function _sign (array $pay) : string
    {
        ksort($pay);
        $sign = '';
        foreach ($pay as $item => $value) {
            $sign .= $item . '=' . $value . '&';
        }

        $sign .= md5($this->token);
        return md5($sign);
    }
}