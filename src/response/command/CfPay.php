<?php

namespace GERCLLC\SDK\response\command;

use GERCLLC\SDK\abstracts\ResponseCommand;

class CfPay extends ResponseCommand
{
    public function getStatus()
    {
        return (string)$this->response['data']['status'];
    }

    public function getLink()
    {
        return (string)$this->response['data']['link'];
    }
}