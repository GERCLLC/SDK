<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonCancelHold\Body as ConstructCommonCancelHoldBody;
use GERCLLC\SDK\response\command\CancelHold as ResponseCommandCancelHold;

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

    /**
     * @param array $data
     * @return ResponseCommandCancelHold
     */
    protected function getResponseObjectName(array $data): ResponseCommandCancelHold
    {
        return new ResponseCommandCancelHold($data);
    }
}