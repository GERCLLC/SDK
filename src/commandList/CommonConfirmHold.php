<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonConfirmHold\Body as ConstructCommonConfirmHoldBody;
use GERCLLC\SDK\response\command\ConfirmHold as ResponseCommandConfirmHold;

class CommonConfirmHold extends Sender
{
    /**
     * @param ConstructCommonConfirmHoldBody $construct
     * @return CommonConfirmHold
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonConfirmHoldBody $construct)
    {
        $this->setUrl('/index.php?common=confirm');

        return parent::setRequestBodySender($construct);
    }

    /**
     * @param array $data
     * @return ResponseCommandConfirmHold
     */
    protected function getResponseObjectName(array $data): ResponseCommandConfirmHold
    {
        return new ResponseCommandConfirmHold($data);
    }
}