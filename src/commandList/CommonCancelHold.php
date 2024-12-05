<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonCancelHold\Body as ConstructCommonCancelHoldBody;

class CommonCancelHold extends Sender
{
    /**
     * @param ConstructCommonCancelHoldBody $construct
     * @return CommonCancelHold
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonCancelHoldBody $construct)
    {
        $this->setUrl('/index.php?common=cancel_hold');

        return parent::setRequestBodySender($construct);
    }
}