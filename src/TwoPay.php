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
     * @return bool|string
     */
    public function SecurePay(SecurePay $pay) : bool|string
    {
        $pay->merchantNo = $this->merchant_no;

        $array = json_decode(json_encode($pay), true);
        $pay->verifySign = $this->_sign($array);
		$param = json_encode($pay,JSON_UNESCAPED_UNICODE);
        return $this->post($param, self::Secure_Pay);
    }


	public function Refund(string $order_no, string $amount) {

		$param = ["merchantNo"=> $this->merchant_no, "amount" => $amount, "reference"=> $order_no];
		$param["verifySign"] = $this->_sign($param);

		$param = json_encode($param,JSON_UNESCAPED_UNICODE);
		return $this->post($param, self::Refund);
	}


	public function Query(string $order_no) {

		$param = ["merchantNo"=> $this->merchant_no, "reference"=> $order_no];
		$param["verifySign"] = $this->_sign($param);

		$param = json_encode($param,JSON_UNESCAPED_UNICODE);
		return $this->post($param, self::Query);
	}

    private function post (string $post_data, string $url) : bool|string
	{

        $url = self::Base_URL . $url;
        $ch = curl_init();

        curl_setopt($ch, CURLOPT_URL, $url);
        // post数据
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS,$post_data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
                'Content-Type: application/json',
                'Content-Length: ' . strlen($post_data))
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
			if( $value == "" || $item == "verifySign" ){
				continue;
			}
            $sign .= $item . '=' . $value . '&';
        }

        $sign .= md5($this->token);
        return md5($sign);
    }
}