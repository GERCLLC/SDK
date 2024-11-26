<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\commandList\CommonGetID\PayData;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetID;
use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetIDBody;

try {
    // Прописываем конфиг
    Config::getInstance()->setBaseUri('https://fc-pay.gerc.ua');
    Config::getInstance()->setPartnerId('4');
    Config::getInstance()->setPartnerKey('12345');

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

    $response = (new CommonGetID());
    $response->setRequestBody($constructGetIDBody);
    $response->signature();

    echo "\n\n";
    print_r($response->getRequestBodyJson());

    $result = $response->send('/index.php?common=get_id');

    echo "\n\n";
    print_r($result);
    echo "\n\n";
} catch (\Exception $e) {
    print_r($e->getMessage());
}
