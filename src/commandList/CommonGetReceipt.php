<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetReceipt\Body as ConstructCommonGetID;

class CommonGetReceipt extends Sender
{
    /**
     * @param int $partnerID
     * @param int $operID
     * @return $this
     */
    public function setRequestBody(
        int $partnerID,
        int $operID
    )
    {
        $this->setUrl('/index.php?common=get_receipt&partner_id=' . $partnerID . '&oper_id=' . $operID);
        $this->setCheckJson(false);

        return $this;
    }

    /**
     * @return void
     */
    protected function getResponseObjectName()
    {
        // NULL
    }
}