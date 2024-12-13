<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonStartCardValidate;
use GERCLLC\SDK\constructList\commandList\CommonStartCardValidate\Body as CommonStartCardValidateBody;
use GERCLLC\SDK\constructList\commandList\CommonStartCardValidate\PayData;

// Реєстрація платежу

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $payData = (new PayData())
        ->setPointId(42)
        ->setAmount(100)
        ->setDescription('testdescr1');

    $commonStartCardValidateBody = (new CommonStartCardValidateBody())
        ->setPartnerId(4)
        ->setBackrefUrl('https://fc-dev.gerc.ua/test/request_test.php')
        ->setNotifyUrl('https://fc-dev.gerc.ua/test/request_test.php') // ->addPayData()
        ->addPayData($payData)
    ;

    $request = (new CommonStartCardValidate());
    $request->setRequestBody($commonStartCardValidateBody);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();

    echo "\n\n";
    print_r($response);
    echo "\n\n";
} catch (\Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}