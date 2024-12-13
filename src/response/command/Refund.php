<?php

namespace GERCLLC\SDK\response\command;

use GERCLLC\SDK\abstracts\ResponseCommand;

class Refund extends ResponseCommand
{
    /**
     * @return string
     */
    public function getStatus()
    {
        return (string)$this->response['data']['status'];
    }
}