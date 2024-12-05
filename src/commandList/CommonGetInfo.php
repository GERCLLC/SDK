<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetInfo\Body as ConstructCommonGetInfoBody;

class CommonGetInfo extends Sender
{
    /**
     * @param ConstructCommonGetInfoBody $construct
     * @return CommonGetInfo
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonGetInfoBody $construct)
    {
        $this->setUrl('/index.php?common=get_info');

        return parent::setRequestBodySender($construct);
    }
}