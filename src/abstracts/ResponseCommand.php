<?php

namespace GERCLLC\SDK\abstracts;

abstract class ResponseCommand
{
    /**
     * @var array $response
     */
    protected $response;

    public function __construct(array $response)
    {
        $this->response = $response;
    }

    /**
     * @return array
     */
    public function getResponse(): array
    {
        return $this->response;
    }
}