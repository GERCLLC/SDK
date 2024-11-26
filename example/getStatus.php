<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetStatus;
use GERCLLC\SDK\constructList\commandList\CommonGetStatus\Body as ConstructCommonGetStatus;

try {
    // Прописываем конфиг
    Config::getInstance()->setBaseUri('https://fc-pay.gerc.ua');
    Config::getInstance()->setPartnerId('4');
    Config::getInstance()->setPartnerKey('12345');

    $constructGetStatus = (new ConstructCommonGetStatus())
        ->setOperId('954015')
        ->setPartnerId('4')
    ;

    $response = (new CommonGetStatus());
    $response->setRequestBody($constructGetStatus);
    $response->signature();

    echo "\n\n";
    print_r($response->getRequestBodyJson());

    $result = $response->send('/index.php?common=get_status');

    echo "\n\n";
    print_r($result);
    echo "\n\n";
} catch (\Exception $e) {
    print_r($e->getMessage());
}