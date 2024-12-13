<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\TokenPay\Body as ConstructTokenPayBody;
use GERCLLC\SDK\response\command\TokenPay as ResponseCommandTokenPay;

class TokenPay extends Sender
{
    /**
     * @param ConstructTokenPayBody $construct
     * @return TokenPay
     * @throws Exception
     */
    public function setRequestBody(ConstructTokenPayBody $construct)
    {
        $this->setUrl('/index.php?token=pay');
        return parent::setRequestBodySender($construct);
    }

    /**
     * @param array $data
     * @return ResponseCommandTokenPay
     */
    protected function getResponseObjectName(array $data): ResponseCommandTokenPay
    {
        return new ResponseCommandTokenPay($data);
    }
}