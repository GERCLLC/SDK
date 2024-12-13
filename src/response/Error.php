<?php

namespace GERCLLC\SDK\response;

use GERCLLC\SDK\abstracts\Response;

class Error extends Response
{
    /**
     * @return string
     */
    public function getError()
    {
        return (string)$this->response['error'];
    }
}