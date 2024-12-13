<?php

namespace GERCLLC\SDK\commandList;

use Exception;
use GERCLLC\SDK\abstracts\Sender;
use GERCLLC\SDK\constructList\commandList\CommonStartCardValidate\Body as CommonStartCardValidateBody;
use GERCLLC\SDK\response\command\StartCardValidate as ResponseCommandStartCardValidate;

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

    /**
     * @param array $data
     * @return ResponseCommandStartCardValidate
     */
    protected function getResponseObjectName(array $data): ResponseCommandStartCardValidate
    {
        return new ResponseCommandStartCardValidate($data);
    }
}