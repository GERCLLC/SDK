<?php

use PHPUnit\Framework\TestCase;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetFee;
use GERCLLC\SDK\constructList\commandList\CommonGetFee\Body as ConstructCommonGetFeeBody;
use GERCLLC\SDK\constructList\commandList\CommonGetFee\PayData;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommonGetFreeTest extends TestCase
{
    /** @var Serializer $serializer */
    protected $serializer;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Инициализация Serializer
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    public function testCommonFeeID(): void
    {
        $partnerId = 4;

        // Настройка конфигурации
        $config = Config::getInstance();
        $config->setBaseUri('https://fc-pay.gerc.ua');
        $config->setPartnerId($partnerId);
        $config->setPartnerKey('12345');

        $this->assertIsInt($config->getPartnerId(), 'Partner ID должен быть int');
        $this->assertIsString($config->getPartnerKey(), 'Partner ID должен быть string');
        $this->assertIsString($config->getBaseUrl(), 'Partner ID должен быть string');
        $this->assertIsInt($config->getApiVer(), 'Partner ID должен быть int');

        $constructGetFeeBody = (new ConstructCommonGetFeeBody())
            ->setPartnerId($partnerId)
            ->addPayData((new PayData())->setPointId(42)->setAmount(100));

        // Проверка, что getPartnerId возвращает int
        $this->assertIsInt($constructGetFeeBody->getPartnerId(), 'Partner ID должен быть целым числом');
        $this->assertEquals($partnerId, $constructGetFeeBody->getPartnerId());

        // Проверка, что getPayData возвращает массив
        $payData = $constructGetFeeBody->getPayData();
        $this->assertIsArray($payData, 'PayData должен быть массивом');

        $request = (new CommonGetFee())
            ->setRequestBody($constructGetFeeBody)
            ->signature();

        $request->send();
        $response = $request->getResponseStringJson();

        // Декодируем JSON-ответ
        $responseData = json_decode($response, true);
        // Проверка структуры ответа
        $this->assertArrayHasKey('data', $responseData);
        $this->assertArrayHasKey('fee', $responseData['data']);
        $this->assertArrayHasKey('details', $responseData['data']);
        $this->assertIsArray($responseData['data']['details']);
        $this->assertCount(1, $responseData['data']['details']);
    }
}