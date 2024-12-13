<?php

use PHPUnit\Framework\TestCase;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CfPay;
use GERCLLC\SDK\commandList\CommonGetID;
use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetIDBody;
use GERCLLC\SDK\constructList\commandList\CommonGetID\PayData;
use GERCLLC\SDK\constructList\commandList\CfPay\Body as ConstructCfPayBody;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

class CommonGetIDAndPaybyCardTest extends TestCase
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
        $operID = $this->validGetIDTest();

        $this->validPaybyCard($operID);
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
            ->setUserIp('188.163.31.52')
            ->addPaydata($payData);

        $request = (new CommonGetID());
        $request->setRequestBody($constructGetIDBody);
        $request->signature();

        echo "\n\n";
        print_r($request->getRequestBodyJson());

        $request->send();
        $response = $request->getResponseStringJson();

        echo "\n\n";
        print_r($response);
        echo "\n\n";
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

    protected function validPaybyCard(int $operID)
    {
        $testCredential = include (realpath('.' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'testCredential.php'));

        $constructCfPayBody = (new ConstructCfPayBody())
            ->setPartnerId(4)
            ->setOperId($operID)
            ->setColorDepth(24)
            ->setScreenHeight(1080)
            ->setScreenWidth(1920)
            ->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/118.0')
            ->setUserAccept('*/*')
            ->setCardNum($testCredential['test']['4242424242424242']['card'])
            ->setExp($testCredential['test']['4242424242424242']['month'])
            ->setExpYear($testCredential['test']['4242424242424242']['year'])
            ->setCvv($testCredential['test']['4242424242424242']['cvv'])
            ->setEmail('arapov@gerc.ua')
            ->setFio('qwedasd as erer');

        // Проверка полей ConstructCfPayBody
        $this->assertIsInt($constructCfPayBody->getPartnerId());
        $this->assertEquals(4, $constructCfPayBody->getPartnerId());
        $this->assertIsInt($constructCfPayBody->getOperId());
        $this->assertEquals($operID, $constructCfPayBody->getOperId());
        $this->assertIsInt($constructCfPayBody->getColorDepth());
        $this->assertEquals(24, $constructCfPayBody->getColorDepth());
        $this->assertIsInt($constructCfPayBody->getScreenHeight());
        $this->assertEquals(1080, $constructCfPayBody->getScreenHeight());
        $this->assertIsInt($constructCfPayBody->getScreenWidth());
        $this->assertEquals(1920, $constructCfPayBody->getScreenWidth());
        $this->assertIsString($constructCfPayBody->getUserAgent());
        $this->assertEquals('Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/118.0', $constructCfPayBody->getUserAgent());
        $this->assertIsString($constructCfPayBody->getUserAccept());
        $this->assertEquals('*/*', $constructCfPayBody->getUserAccept());
        $this->assertIsString($constructCfPayBody->getCardNum());
        $this->assertEquals($testCredential['test']['4242424242424242']['card'], $constructCfPayBody->getCardNum());
        $this->assertIsString($constructCfPayBody->getExp());
        $this->assertEquals($testCredential['test']['4242424242424242']['month'], $constructCfPayBody->getExp());
        $this->assertIsString($constructCfPayBody->getExpYear());
        $this->assertEquals($testCredential['test']['4242424242424242']['year'], $constructCfPayBody->getExpYear());
        $this->assertIsInt($constructCfPayBody->getCvv());
        $this->assertEquals($testCredential['test']['4242424242424242']['cvv'], $constructCfPayBody->getCvv());
        $this->assertIsString($constructCfPayBody->getEmail());
        $this->assertEquals('arapov@gerc.ua', $constructCfPayBody->getEmail());
        $this->assertIsString($constructCfPayBody->getFio());
        $this->assertEquals('qwedasd as erer', $constructCfPayBody->getFio());

        $request = (new CfPay())
            ->setRequestBody($constructCfPayBody)
            ->signature();

        echo "\n\n";
        print_r($request->getRequestBodyJson());

        $request->send();
        $response = $request->getResponseStringJson();
        echo "\n\n";
        print_r($response);
        echo "\n\n";

        // Декодирование JSON-ответа
        $responseArray = json_decode($response, true);
    }
}