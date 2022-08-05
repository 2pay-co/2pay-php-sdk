<?php
declare(strict_types=1);
namespace Pay;

class TwoPay
{
    private string $merchant_no;
    private string $token;

    /**
     * @return string
     */
    public function getToken(): string
    {
        return $this->token;
    }

    /**
     * @param string $token
     */
    public function setToken(string $token): void
    {
        $this->token = $token;
    }

    /**
     * @param string $merchant_no
     * @return TwoPay
     */
    public function setMerchantNo(string $merchant_no): TwoPay
    {
        $this->merchant_no = $merchant_no;
        return $this;
    }

    /**
     * @return string
     */
    public function getMerchantNo(): string
    {
        return $this->merchant_no;
    }

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
        $pay->MerchantNo = $this->merchant_no;

        $pay->VerifySign = $this->_verifySign((array) $pay);

    }


    private function _verifySign (array $pay) : string
    {

        return '';
    }
}