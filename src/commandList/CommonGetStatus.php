<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetStatus\Body as ConstructCommonGetStatus;
use GERCLLC\SDK\response\command\GetStatus as ResponseCommandGetStatus;

class CommonGetStatus extends Sender
{
    /**
     * @param ConstructCommonGetStatus $construct
     * @return CommonGetStatus
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonGetStatus $construct)
    {
        $this->setUrl('/index.php?common=get_status');
        return parent::setRequestBodySender($construct);
    }

    /**
     * @param array $data
     * @return ResponseCommandGetStatus
     */
    protected function getResponseObjectName(array $data): ResponseCommandGetStatus
    {
        return new ResponseCommandGetStatus($data);
    }
}