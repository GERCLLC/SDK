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
    $request->setRequestBody(4, 971147);

    $response = $request->send();
    // Зберігаєм у файл
    file_put_contents('receipt-' . time() . '.pdf', $response);
} catch (\Exception $e) {
    print_r($e->getMessage());
}