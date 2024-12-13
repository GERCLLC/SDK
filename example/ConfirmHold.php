<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonConfirmHold;
use GERCLLC\SDK\constructList\commandList\CommonConfirmHold\PaymentData;
use GERCLLC\SDK\constructList\commandList\CommonConfirmHold\Body as ConstructCommonConfirmHoldBody;

// Підтвердження платежу (hold)

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $paymentData = (new PaymentData())
        ->setPointId(42)
        ->setRecordId(901224)
        ->setAmount(3000);

    $constructCommonConfirmHoldBody = (new ConstructCommonConfirmHoldBody())
        ->setOperId(201144)
        ->setPartnerId(4)
        ->addPaymentData($paymentData);

    $request = (new CommonConfirmHold());
    $request->setRequestBody($constructCommonConfirmHoldBody);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();

    echo "\n\n";
    print_r($response);
    echo "\n\n";
} catch (Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}