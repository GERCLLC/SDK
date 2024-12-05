<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetFee\Body as ConstructCommonGetFeeBody;

class CommonGetFee extends Sender
{
    /**
     * @param ConstructCommonGetFeeBody $construct
     * @return CommonGetFee
     * @throws Exception
     */
    public function setRequestBody(ConstructCommonGetFeeBody $construct)
    {
        $this->setUrl('/index.php?common=get_fee');

        return parent::setRequestBodySender($construct);
    }
}