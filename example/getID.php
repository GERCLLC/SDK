<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\commandList\CommonGetID\PayData;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetID;
use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetIDBody;

// Реєстрація платежу (від 1 до N точок продажу)

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $payData = (new PayData())
        ->setPointId('42')
        ->setAmount('100')
        ->setDescription('testdescr1')
        ->setExtraParams(" ewog12222zEyMyIKfQ==")
        ->setPayer("Петров П.П.")
    ;

    $constructGetIDBody = (new ConstructCommonGetIDBody())
        ->setPartnerId('4')
        ->addPaydata($payData)
        ->addPaydata($payData)
    ;

    $request = (new CommonGetID());
    $request->setRequestBody($constructGetIDBody);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());

    $response = $request->send();

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
