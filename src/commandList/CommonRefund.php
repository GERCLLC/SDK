<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonRefund\Body as ConstructCommonRefund;

class CommonRefund extends Sender
{
    /**
     * @param ConstructCommonRefund $construct
     * @return CommonRefund
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonRefund $construct)
    {
        $this->setUrl('/index.php?common=refund');
        return parent::setRequestBodySender($construct);
    }
}