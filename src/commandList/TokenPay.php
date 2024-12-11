<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\TokenPay\Body as ConstructTokenPayBody;

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
}