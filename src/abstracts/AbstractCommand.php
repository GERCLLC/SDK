<?php

namespace GERCLLC\SDK\abstracts;

use Exception;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class AbstractCommand
{
    /** @var Serializer $serializer */
    protected $serializer;

    public function __construct()
    {
        // Инициализация Serializer
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    abstract public function valid(): bool;

    abstract public function getArray(): array;

    /**
     * @return Serializer
     */
    public function getSerializer(): Serializer
    {
        return $this->serializer;
    }

    /**
     * @param Serializer $serializer
     */
    public function setSerializer(Serializer $serializer): void
    {
        $this->serializer = $serializer;
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getJson(): string
    {
        if (!$this->valid()) {
            throw new Exception('Failed validation');
        }

        // Сериализация массива в JSON
        return $this->serializer->serialize($this->getArray(), 'json', [
            'json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ]);
    }
}