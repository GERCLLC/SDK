<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\commandList\CommonRefund\RefundData;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonRefund;
use GERCLLC\SDK\constructList\commandList\CommonRefund\Body as ConstructCommonRefund;

try {
    // Прописываем конфиг
    Config::getInstance()->setBaseUri('https://fc-pay.gerc.ua');
    Config::getInstance()->setPartnerId('4');
    Config::getInstance()->setPartnerKey('12345');

    $refundData = (new RefundData())
        ->setPointId('42')
        ->setRecordId('1764267')
        ->setAmount('100');

    $constructRefund = (new ConstructCommonRefund)
        ->setOperId('954015')
        ->setPartnerId('4')
        ->addRefundData($refundData);

    $response = (new CommonRefund());
    $response->setRequestBody($constructRefund);
    $response->signature();

    echo "\n\n";
    print_r($response->getRequestBodyJson());

    $result = $response->send('/index.php?common=refund');

    echo "\n\n";
    print_r($result);
    echo "\n\n";
} catch (\Exception $e) {
    print_r($e->getMessage());
}