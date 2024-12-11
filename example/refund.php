<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\commandList\CommonRefund\RefundData;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonRefund;
use GERCLLC\SDK\constructList\commandList\CommonRefund\Body as ConstructCommonRefund;

// Запит повернення коштів

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $refundData = (new RefundData())
        ->setPointId('42')
        ->setRecordId('1764267')
        ->setAmount('100');

    $constructRefund = (new ConstructCommonRefund)
        ->setOperId('954015')
        ->setPartnerId('4')
        ->addRefundData($refundData);

    $request = (new CommonRefund());
    $request->setRequestBody($constructRefund);
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