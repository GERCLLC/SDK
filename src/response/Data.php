<?php

namespace GERCLLC\SDK\response;

use GERCLLC\SDK\abstracts\Response;
use GERCLLC\SDK\abstracts\ResponseCommand;

class Data extends Response
{
    protected $data;

    public function __construct(ResponseCommand $data)
    {
        $this->data = $data;

        parent::__construct($data->getResponse());
    }

    /**
     * @return mixed|ResponseCommand
     */
    public function getData()
    {
        return $this->data;
    }

    /**
     * @return string
     */
    public function getSignature()
    {
        return (string)$this->response['signature'];
    }
}