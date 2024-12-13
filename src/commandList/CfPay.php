<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CfPay\Body as ConstructCfPayBody;
use GERCLLC\SDK\response\command\CfPay as ResponseCommandCfPay;

class CfPay extends Sender
{
    /**
     * @param ConstructCfPayBody $construct
     * @return CfPay
     * @throws Exception
     */
    public function setRequestBody(ConstructCfPayBody $construct)
    {
        $this->setUrl('/index.php?cf=pay');

        return parent::setRequestBodySender($construct);
    }

    /**
     * @param array $data
     * @return ResponseCommandCfPay
     */
    protected function getResponseObjectName(array $data): ResponseCommandCfPay
    {
        return new ResponseCommandCfPay($data);
    }
}