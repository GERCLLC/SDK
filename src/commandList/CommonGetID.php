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
        $this->setUrl('/index.php?common=get_id');
        return parent::setRequestBodySender($construct);
    }
}