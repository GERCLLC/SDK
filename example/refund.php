<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\commandList\CommonRefund\RefundData;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonRefund;
use GERCLLC\SDK\constructList\commandList\CommonRefund\Body as ConstructCommonRefund;
use GERCLLC\SDK\response\command\Refund as ResponseCommandRefund;
use GERCLLC\SDK\response\Error;

// Запит повернення коштів

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $refundData = (new RefundData())
        ->setPointId('42')
        ->setRecordId('1820208')
        ->setAmount('100');

    $constructRefund = (new ConstructCommonRefund)
        ->setOperId('987719')
        ->setPartnerId('4')
        ->addRefundData($refundData);

    $request = (new CommonRefund());
    $request->setRequestBody($constructRefund);
    $request->signature();
    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();
    echo "\n\n";
    print_r($response);
    echo "\n\n";

    $object = $request->getResponseObject();
    if ($object instanceof Error) {
        print_r($object->getError());
        echo "\n\n";
        exit();
    }
    /** @var ResponseCommandRefund $data */
    $data = $object->getData();
    echo "\n\n";
    print_r($data->getStatus());
    echo "\n\n";
} catch (\Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}