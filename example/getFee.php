<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetFee;
use GERCLLC\SDK\constructList\commandList\CommonGetFee\Body as ConstructCommonGetFeeBody;
use GERCLLC\SDK\constructList\commandList\CommonGetFee\PayData;

// Розрахунок комісії

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $constructGetFeeBody = (new ConstructCommonGetFeeBody())
        ->setPartnerId(4)
        ->addPayData((new PayData())->setPointId(42)->setAmount(100));

    $request = (new CommonGetFee())
        ->setRequestBody($constructGetFeeBody)
        ->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();

    echo "\n\n";
    print_r($response);
    echo "\n\n";
    $object = $request->getResponseObject();

    // Перевіряємо чи є помилка
    if ($object instanceof \GERCLLC\SDK\response\Error) {
        print_r($object->getError());
        echo "\n\n";
        exit();
    }


} catch (Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}
