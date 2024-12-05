<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetStatus\Body as ConstructCommonGetStatus;

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
}