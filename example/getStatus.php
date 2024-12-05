<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetStatus;
use GERCLLC\SDK\constructList\commandList\CommonGetStatus\Body as ConstructCommonGetStatus;

// Отримання статусу операції

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $constructGetStatus = (new ConstructCommonGetStatus())
        ->setOperId('963937')
        ->setPartnerId('4')
    ;

    $request = (new CommonGetStatus());
    $request->setRequestBody($constructGetStatus);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());

    $response = $request->send();

    echo "\n\n";
    print_r($response);
    echo "\n\n";
} catch (\Exception $e) {
    print_r($e->getMessage());
}