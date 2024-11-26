<?php

namespace GERCLLC\SDK\abstracts;

use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetIDBody;
use GERCLLC\SDK\constructList\Config;
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
    /** @var string $partner_id */
    protected $partner_id = '';

    /** @var string $partner_key */
    protected $partner_key = '';

    /** @var Serializer $serializer */
    protected $serializer;

    /** @var Client $client */
    protected $client;

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

        if (!is_string(Config::getInstance()->getPartnerId())) {
            throw new Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        if (!is_string(Config::getInstance()->getPartnerKey())) {
            throw new Exception(__FILE__ . ' line ' . __LINE__ . '. Must be of the type string given');
        }

        $this->partner_id = Config::getInstance()->getPartnerId();
        $this->partner_key = Config::getInstance()->getPartnerKey();

        // Инициализация сериализатора
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
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
     * @param string $uri
     * @return string
     * @throws Exception
     */
    public function send(string $uri): string
    {
        // Проверяем наличие ключа 'data'
        if (!isset($this->body['data'])) {
            throw new Exception(__FILE__ . ' line ' . __LINE__ . ". The key 'data' was not found in the array");
        }

        try {
            $response = $this->client->post($uri, [
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

        // Получение ответа
        return $response->getBody()->getContents();
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

    public function getRequestBodyJson(): string
    {
        return $this->serializer->serialize($this->body, 'json', [
            'json_encode_options' => JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES
        ]);
    }
}