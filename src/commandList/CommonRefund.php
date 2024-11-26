<?php

namespace GERCLLC\SDK\commandList;

use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonRefund\Body as ConstructCommonRefund;

class CommonRefund extends Sender
{
    /**
     * @param ConstructCommonRefund $construct
     * @return CommonGetID
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonRefund $construct)
    {
        return parent::setRequestBodySender($construct);
    }
}