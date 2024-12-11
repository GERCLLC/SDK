<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonStartCardValidate\Body as CommonStartCardValidateBody;

class CommonStartCardValidate extends Sender
{
    /**
     * @param CommonStartCardValidateBody $construct
     * @return CommonStartCardValidate
     * @throws Exception
     */
    public function setRequestBody(CommonStartCardValidateBody $construct)
    {
        $this->setUrl('/index.php?common=start_card_validate');
        return parent::setRequestBodySender($construct);
    }
}