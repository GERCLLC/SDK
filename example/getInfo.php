<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetInfo;
use GERCLLC\SDK\constructList\commandList\CommonGetInfo\PayData;
use GERCLLC\SDK\constructList\commandList\CommonGetInfo\Body as ConstructCommonGetInfoBody;

// Запит довідкової інформації
// TODO: Відповідь {"error":"Доступ заборонено"}, потрібно розібратись

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $constructGetIDBody = (new ConstructCommonGetInfoBody())
        ->setPartnerId('4')
        ->addPayData((new PayData())->setPointId(42))
        ->addPayData((new PayData())->setPointId(43))
        ->addPayData((new PayData())->setPointId(44))
        ->addPayData((new PayData())->setPointId(45));

    $request = (new CommonGetInfo());
    $request->setRequestBody($constructGetIDBody);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();
    echo "\n\n";
    print_r($response);
    echo "\n\n";
    $object = $request->getResponseObject();
    echo "\n";
    print_r($object->getError());
} catch (\Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}