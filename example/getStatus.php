<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetStatus;
use GERCLLC\SDK\constructList\commandList\CommonGetStatus\Body as ConstructCommonGetStatus;
use GERCLLC\SDK\response\command\GetStatus as ResponseCommandGetStatus;
use GERCLLC\SDK\response\Error;

// Отримання статусу операції

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $constructGetStatus = (new ConstructCommonGetStatus())
        ->setOperId('987717')
        ->setPartnerId('4')
    ;

    $request = (new CommonGetStatus());
    $request->setRequestBody($constructGetStatus);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();
    echo "\n\n";
    print_r($response);
    echo "\n\n";
    $object = $request->getResponseObject();
    if (!empty($object instanceof Error)) {
        print_r($object->getError());
        exit();
    }

    /** @var ResponseCommandGetStatus $data */
    $data = $object->getData();
    print_r($data->getOperID());
    echo "\n";
    print_r($data->getStatus());
    echo "\n";
} catch (\Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}