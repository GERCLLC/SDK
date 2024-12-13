<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CfPay;
use GERCLLC\SDK\constructList\commandList\CfPay\Body as ConstructCfPayBody;
use GERCLLC\SDK\response\command\CfPay as ResponseCommandCfPay;
use GERCLLC\SDK\response\Error;

// Оплата карткою

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $testCredential = include ('..' . DIRECTORY_SEPARATOR . 'config' . DIRECTORY_SEPARATOR . 'testCredential.php');

    $constructCfPayBody = (new ConstructCfPayBody())
        ->setPartnerId(4)
        ->setOperId(987714)
        ->setColorDepth(24)
        ->setScreenHeight(1080)
        ->setScreenWidth(1920)
        ->setUserAgent('Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:109.0) Gecko/20100101 Firefox/118.0')
        ->setUserAccept('*/*')
        ->setCardNum($testCredential['test']['4242424242424242']['card'])
        ->setExp($testCredential['test']['4242424242424242']['month'])
        ->setExpYear($testCredential['test']['4242424242424242']['year'])
        ->setCvv($testCredential['test']['4242424242424242']['cvv'])
        ->setEmail('arapov@gerc.ua')
        ->setFio('qwedasd as erer');

    $request = (new CfPay())
        ->setRequestBody($constructCfPayBody)
        ->signature();

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

    /** @var ResponseCommandCfPay $data */
    $data = $object->getData();
    print_r($data);

} catch (Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}