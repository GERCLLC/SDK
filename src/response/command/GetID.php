<?php

namespace GERCLLC\SDK\response\command;

use GERCLLC\SDK\abstracts\ResponseCommand;

class GetID extends ResponseCommand
{
    /**
     * @return int
     */
    public function getOperID()
    {
        return (int)$this->response['data']['oper_id'];
    }

    /**
     * @return string
     */
    public function getLink()
    {
        return (string)$this->response['data']['link'];
    }

    /**
     * @return int
     */
    public function getFee()
    {
        return (int)$this->response['data']['fee'];
    }
}