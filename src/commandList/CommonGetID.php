<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetID;
use GERCLLC\SDK\response\command\GetID as ResponseCommandGetID;

class CommonGetID extends Sender
{
    /**
     * @param ConstructCommonGetID $construct
     * @return CommonGetID
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonGetID $construct)
    {
        $this->setUrl('/index.php?common=get_id');

        return parent::setRequestBodySender($construct);
    }

    /**
     * @param array $data
     * @return ResponseCommandGetID
     */
    protected function getResponseObjectName(array $data): ResponseCommandGetID
    {
        return new ResponseCommandGetID($data);
    }
}