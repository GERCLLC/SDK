<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonGetReceipt\Body as ConstructCommonGetID;

class CommonGetReceipt extends Sender
{
    /**
     * @param int $partner_id
     * @param int $oper_id
     * @return $this
     */
    public function setRequestBody(
        int $partner_id,
        int $oper_id
    )
    {
        $this->setUrl('/index.php?common=get_receipt&partner_id=' . $partner_id . '&oper_id=' . $oper_id);
        return $this;
    }
}