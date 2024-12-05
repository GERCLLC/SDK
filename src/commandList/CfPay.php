<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CfPay\Body as ConstructCfPayBody;

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
}