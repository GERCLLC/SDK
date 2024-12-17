<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetInfo;
use GERCLLC\SDK\constructList\commandList\CommonGetInfo\PayData;
use GERCLLC\SDK\constructList\commandList\CommonGetInfo\Body as ConstructCommonGetInfoBody;
use GERCLLC\SDK\response\command\GetInfo as ResponseCommandGetInfo;

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

    // Перевіряємо чи є помилка
    if ($object instanceof \GERCLLC\SDK\response\Error) {
        print_r($object->getError());
        echo "\n\n";
        exit();
    }

    echo "\n\n";
    /** @var ResponseCommandGetInfo $data */
    $data = $object->getData();
    echo "\n";

    print_r($data->getDataList());
} catch (\Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}