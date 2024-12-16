<?php

namespace GERCLLC\SDK\abstracts;

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\helper\JSON;
use GERCLLC\SDK\response\Data;
use GERCLLC\SDK\response\Error;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Exception;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Exception\RequestException;
use GuzzleHttp\Exception\ServerException;

abstract class Sender
{
    /** @var bool $checkJson */
    protected $checkJson = true;

    /** @var string $partner_id */
    protected $partner_id = '';

    /** @var string $partner_key */
    protected $partner_key = '';

    /** @var Serializer $serializer */
    protected $serializer;

    /** @var Client $client */
    protected $client;

    /** @var string $url */
    protected $url;

    /** @var string $responseJson */
    protected $responseStringJson;

    /** @var array $body */
    protected $body = [];

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => Config::getInstance()->getBaseUrl(),
            'timeout' => 30.0,
        ]);

        if (empty(Config::getInstance()->getPartnerId()) || empty(Config::getInstance()->getPartnerId())) {
            throw new Exception(__FILE__ . ' line ' . __LINE__ . '. Must be not empty');
        }

        if (!is_int(Config::getInstance()->getPartnerId())) {
            throw new Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        if (!is_string(Config::getInstance()->getPartnerKey())) {
            throw new Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        // Перевіряємо чи є абстрактний метод
        if (!method_exists($this, 'getResponseObjectName')) {
            throw new Exception('Method is missing getResponseObjectName ');
        }

        $this->partner_id = Config::getInstance()->getPartnerId();
        $this->partner_key = Config::getInstance()->getPartnerKey();

        // Инициализация сериализатора
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    /**
     * @param $checkJson
     * @return $this
     */
    protected function setCheckJson($checkJson = true): self
    {
        $this->checkJson = $checkJson;

        return $this;
    }

    /**
     * @return $this
     */
    public function signature()
    {
        $data = $this->removeWhitespaceAndNewlines(
            $this->serializer->serialize($this->body['data'], 'json', [
                'json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
            ])
        );

        $this->body['signature'] = sha1(sha1($data) . sha1(Config::getInstance()->getPartnerId() . Config::getInstance()->getPartnerKey()));;

        return $this;
    }

    /**
     * @param string $text
     * @return string
     */
    protected function removeWhitespaceAndNewlines(string $text): string
    {
        $data = json_decode($text, true);

        // Кодируем обратно в JSON
        return $this->serializer->serialize($data, 'json', [
            'json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ]);
    }

    /**
     * @return void
     * @throws Exception
     */
    public function send(): void
    {
        try {
            $response = $this->client->post($this->url, [
                'headers' => [
                    'Content-Type' => 'application/json',
                ],
                // Автоматическое преобразование массива в JSON
                'json' => $this->body,
            ]);
        } catch (ClientException $e) {
            // Ошибки клиента (4xx)
            throw new Exception(
                sprintf(
                    "Client error: %s\nResponse: %s",
                    $e->getMessage(),
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body'
                )
            );
        } catch (ServerException $e) {
            // Ошибки сервера (5xx)
            throw new Exception(
                sprintf(
                    "Server error: %s\nResponse: %s",
                    $e->getMessage(),
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body'
                )
            );
        } catch (RequestException $e) {
            // Другие ошибки HTTP-запроса
            throw new Exception(
                sprintf(
                    "Request error: %s\nResponse: %s",
                    $e->getMessage(),
                    $e->getResponse() ? $e->getResponse()->getBody()->getContents() : 'No response body'
                )
            );
        } catch (Exception $e) {
            // Другие исключения
            throw new Exception(
                sprintf("Unexpected error: %s", $e->getMessage())
            );
        }

        try {
            // Получение ответа
            $jsonString = $response->getBody()->getContents();

            if (true === $this->checkJson) {
                if (!JSON::isValidStringJson($jsonString)) {
                    throw new Exception('JSON is invalid');
                }
            }

            $this->responseStringJson = $jsonString;
        } catch (Exception $e) {
            throw new Exception(
                sprintf("Answer is invalid: %s", $e->getMessage())
            );
        }
    }

    /**
     * @param AbstractCommand $construct
     * @return $this
     * @throws Exception
     */
    protected function setRequestBodySender(AbstractCommand $construct)
    {
        $dataArray = $this->serializer->decode($construct->getJson(), 'json');

        if (!is_array($dataArray)) {
            throw new \Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type array given');
        }

        $this->body['data'] = $dataArray;

        return $this;
    }

    /**
     * @param string $url
     * @return $this
     */
    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    /**
     * @return string
     */
    public function getUrl(): string
    {
        return $this->url;
    }

    public function getRequestBodyJson(): string
    {
        return $this->serializer->serialize($this->body, 'json', [
            'json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ]);
    }

    /**
     * @return string
     * @throws Exception
     */
    public function getResponseStringJson()
    {
        if (true === $this->checkJson) {
            if (empty($this->responseStringJson)) {
                throw new Exception('Response is Empty');
            }
        }

        return $this->responseStringJson;
    }

    /**
     * @return Data|Error
     * @throws Exception
     */
    public function getResponseObject()
    {
        if (empty($this->responseStringJson)) {
            throw new Exception('Response is Empty');
        }

        if (JSON::isValidStringJson($this->responseStringJson)) {
            $array = $this->serializer->decode($this->responseStringJson, 'json');

            if (array_key_exists('data', $array)) {
                $object = new Data($this->getResponseObjectName($array));
            } elseif (array_key_exists('error', $array)) {
                $object = new Error($array);
            } else {
                throw new Exception('Array is invalid');
            }
        } else {
            throw new Exception('JSON is invalid');
        }

        return $object;
    }

    /**
     * abstract protected function getResponseObjectName();
     */
}