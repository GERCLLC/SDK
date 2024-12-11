<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonCancelHold;
use GERCLLC\SDK\constructList\commandList\CommonCancelHold\Body as ConstructCommonCancelHoldBody;

// Відміна платежу (hold)

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $constructCommonCancelHoldBody = (new ConstructCommonCancelHoldBody())
        ->setPartnerId('4')
        ->setOperId(969188)
    ;

    $request = (new CommonCancelHold());
    $request->setRequestBody($constructCommonCancelHoldBody);
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