<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\constructList\commandList\TokenPay\Body as ConstructTokenPayBody;
use \GERCLLC\SDK\commandList\TokenPay;

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $constructTokenPayBody = (new ConstructTokenPayBody)
        ->setPartnerId(4)
        ->setOperId(200994)
        ->setCardToken('sandbox_token');

    $request = (new TokenPay())
        ->setRequestBody($constructTokenPayBody)
        ->signature();

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