<?php

use PHPUnit\Framework\TestCase;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetID;
use GERCLLC\SDK\commandList\CommonGetStatus;
use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetIDBody;
use GERCLLC\SDK\constructList\commandList\CommonGetID\PayData;
use GERCLLC\SDK\constructList\commandList\CommonGetStatus\Body as ConstructCommonGetStatus;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommonGetIDAndGetStatusTest extends TestCase
{
    /** @var Serializer $serializer */
    protected $serializer;

    public function __construct(?string $name = null, array $data = [], $dataName = '')
    {
        parent::__construct($name, $data, $dataName);

        // Инициализация Serializer
        $this->serializer = new Serializer([new ObjectNormalizer()], [new JsonEncoder()]);
    }

    public function testCommonGetID(): void
    {
        //
        $this->notValidGetIDPartnerKeyTest();

        //
        $operID = $this->validGetIDTest();

        echo "\n\n";
        //
        print_r($operID);

        //
        $this->validGetStatusTest($operID);
    }

    /**
     * @return int
     * @throws Exception
     */
    protected function validGetIDTest(): int
    {
        // Настройка конфигурации
        $config = Config::getInstance();
        $config->setBaseUri('https://fc-pay.gerc.ua');
        $config->setPartnerId('4');
        $config->setPartnerKey('12345');

        $this->assertIsInt($config->getPartnerId(), 'Partner ID должен быть int');
        $this->assertIsString($config->getPartnerKey(), 'Partner ID должен быть string');
        $this->assertIsString($config->getBaseUrl(), 'Partner ID должен быть string');
        $this->assertIsInt($config->getApiVer(), 'Partner ID должен быть int');

        // Создание объекта PayData
        $payData = (new PayData())
            ->setPointId('42')
            ->setAmount('100')
            ->setDescription('testdescr1')
            ->setExtraParams(" ewog12222zEyMyIKfQ==")
            ->setPayer("Петров П.П.");

        $this->assertEquals('42', $payData->getPointId());
        $this->assertEquals('100', $payData->getAmount());
        $this->assertEquals('testdescr1', $payData->getDescription());
        $this->assertEquals(" ewog12222zEyMyIKfQ==", $payData->getExtraParams());
        $this->assertEquals("Петров П.П.", $payData->getPayer());

        // Создание тела запроса
        $constructGetIDBody = (new ConstructCommonGetIDBody())
            ->setPartnerId('4')
            ->addPaydata($payData)
            ->addPaydata($payData);

        $this->assertEquals('4', $constructGetIDBody->getPartnerId());
        $this->assertCount(2, $constructGetIDBody->getPayDataArray());

        // Создание и настройка объекта CommonGetID
        $request = new CommonGetID();
        $request->setRequestBody($constructGetIDBody);
        $request->signature();

        $jsonBody = $request->getRequestBodyJson();
        $this->assertNotEmpty($jsonBody);
        $this->assertJson($jsonBody);

        // Отправки запроса
        $response = $request->send();
        $this->assertNotEmpty($response);
        $this->assertJson($response);

        $responseArray = $this->serializer->decode($response, 'json');

        // Проверка ответа
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertArrayHasKey('signature', $responseArray);

        // Проверяем, что signature — строка
        $this->assertIsString($responseArray['signature']);
        $this->assertMatchesRegularExpression('/^[a-f0-9]{40}$/', $responseArray['signature']);

        $data = $responseArray['data'];
        // Регулярные выражения для проверки значений
        $patterns = [
            'oper_id' => '/^\d+$/', // Целое число
            'link' => '/^https:\/\/fc-pay\.gerc\.ua\/index\.php\?common=show&partner_id=\d+&oper_id=\d+$/', // URL с параметрами
            'fee' => '/^\d+$/', // Целое число
        ];

        // Выполняем проверку
        foreach ($patterns as $key => $pattern) {
            $this->assertArrayHasKey($key, $data, "Key '$key' is missing in the array.");
            $this->assertMatchesRegularExpression($pattern, (string)$data[$key], "Value of '$key' does not match the pattern.");
        }

        return $data['oper_id'];
    }

    protected function notValidGetIDPartnerKeyTest()
    {
        // Настройка конфигурации
        $config = Config::getInstance();
        $config->setBaseUri('https://fc-pay.gerc.ua');
        $config->setPartnerId('4');
        $config->setPartnerKey('123456');

        $this->assertIsInt($config->getPartnerId(), 'Partner ID должен быть int');
        $this->assertIsString($config->getPartnerKey(), 'Partner ID должен быть string');
        $this->assertIsString($config->getBaseUrl(), 'Partner ID должен быть string');
        $this->assertIsInt($config->getApiVer(), 'Partner ID должен быть int');

        // Создание объекта PayData
        $payData = (new PayData())
            ->setPointId('42')
            ->setAmount('100')
            ->setDescription('testdescr1')
            ->setExtraParams(" ewog12222zEyMyIKfQ==")
            ->setPayer("Петров П.П.");

        $this->assertEquals('42', $payData->getPointId());
        $this->assertEquals('100', $payData->getAmount());
        $this->assertEquals('testdescr1', $payData->getDescription());
        $this->assertEquals(" ewog12222zEyMyIKfQ==", $payData->getExtraParams());
        $this->assertEquals("Петров П.П.", $payData->getPayer());

        // Создание тела запроса
        $constructGetIDBody = (new ConstructCommonGetIDBody())
            ->setPartnerId('4')
            ->addPaydata($payData);

        $this->assertEquals('4', $constructGetIDBody->getPartnerId());

        // Создание и настройка объекта CommonGetID
        $request = new CommonGetID();
        $request->setRequestBody($constructGetIDBody);
        $request->signature();

        $jsonBody = $request->getRequestBodyJson();
        $this->assertNotEmpty($jsonBody);
        $this->assertJson($jsonBody);

        // Отправки запроса
        $response = $request->send();
        $this->assertNotEmpty($response);
        $this->assertJson($response);

        $responseArray = $this->serializer->decode($response, 'json');
        $this->assertArrayHasKey('error', $responseArray);
    }

    protected function validGetStatusTest(int $operID)
    {
        $config = Config::getInstance();
        // Прописываем конфиг
        $config->setBaseUri('https://fc-pay.gerc.ua');
        $config->setPartnerId('4');
        $config->setPartnerKey('12345');

        $this->assertIsInt($config->getPartnerId(), 'Partner ID должен быть int');
        $this->assertIsString($config->getPartnerKey(), 'Partner ID должен быть string');
        $this->assertIsString($config->getBaseUrl(), 'Partner ID должен быть string');
        $this->assertIsInt($config->getApiVer(), 'Partner ID должен быть int');

        $constructGetStatus = (new ConstructCommonGetStatus())
            ->setOperId($operID)
            ->setPartnerId('4')
        ;

        $request = (new CommonGetStatus());
        $request->setRequestBody($constructGetStatus);
        $request->signature();

        $response = $request->send();
        $responseArray = $this->serializer->decode($response, 'json');

        // Проверяем ключи верхнего уровня
        $this->assertArrayHasKey('data', $responseArray);
        $this->assertArrayHasKey('signature', $responseArray);

        // Проверяем, что signature — строка
        $this->assertIsString($responseArray['signature']);
        $this->assertMatchesRegularExpression('/^[a-f0-9]{40}$/', $responseArray['signature']);

        // Проверяем ключи в блоке data
        $data = $responseArray['data'];
        $this->assertArrayHasKey('oper_id', $data);
        $this->assertArrayHasKey('points_data', $data);

        // Проверяем, что oper_id — число
        $this->assertIsInt($data['oper_id']);

        // Проверяем points_data
        $pointsData = $data['points_data'];
        $this->assertIsArray($pointsData);

        foreach ($pointsData as $point) {
            $this->assertArrayHasKey('record_id', $point);
            $this->assertArrayHasKey('amount', $point);
            $this->assertArrayHasKey('pay_descr', $point);
            $this->assertArrayHasKey('payer', $point);

            // Проверяем значения внутри points_data
            $this->assertIsInt($point['record_id']);
            $this->assertIsInt($point['amount']);
            $this->assertIsString($point['pay_descr']);
            $this->assertIsString($point['payer']);
        }
    }
}