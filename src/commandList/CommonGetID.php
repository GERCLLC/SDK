<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;

use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetID;

class CommonGetID extends Sender
{
    /**
     * @param ConstructCommonGetID $construct
     * @return CommonGetID
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonGetID $construct)
    {
        return parent::setRequestBodySender($construct);
    }
}