<?php

namespace GERCLLC\SDK\abstracts;

abstract class Response
{
    /**
     * @var array $response
     */
    protected $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }
}