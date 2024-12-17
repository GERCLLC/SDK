<?php

namespace GERCLLC\SDK\response\command;

use GERCLLC\SDK\abstracts\ResponseCommand;

class GetInfo extends ResponseCommand
{
    public function getDataList()
    {
        return $this->response['data'];
    }
}