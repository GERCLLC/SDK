<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetReceipt;

// Отримання квітанції в pdf форматі

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $request = (new CommonGetReceipt());
    $request->setRequestBody(4, 987717);

    $request->send();
    $response = $request->getResponseStringJson();
    // Зберігаєм у файл
    file_put_contents('receipt-' . time() . '.pdf', $response);
} catch (\Exception $e) {
    echo "\n\n";
    print_r($e->getFile());
    echo "\n";
    print_r($e->getLine());
    echo "\n";
    print_r($e->getMessage());
}