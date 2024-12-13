<?php

require_once '../vendor/autoload.php';

use GERCLLC\SDK\constructList\commandList\CommonGetID\PayData;
use GERCLLC\SDK\constructList\Config;
use GERCLLC\SDK\commandList\CommonGetID;
use GERCLLC\SDK\constructList\commandList\CommonGetID\Body as ConstructCommonGetIDBody;

// Реєстрація платежу з тимчасовим утриманням коштів (холдування)

// Якщо ви плануєте реєструвати платежі з операцією "холдування"
// (тимчасове блокування коштів на рахунку),
// будь ласка, зверніть увагу на параметр oper_type у вашому запиті.

// За замовчуванням цей параметр має значення 1,
// що вказує на стандартну операцію реєстрації платежу

// Для того, щоб зареєструвати платіж з операцією "холдування",
// встановіть значення oper_type = 2 ("oper_type":2). Це дозволить заблокувати
// необхідну суму на рахунку до фактичного здійснення платежу. Після цього ви зможете
// підтвердити платіж по API (див. запит Confirm Hold).
// Будь ласка, переконайтеся, що ваші запити на реєстрацію платежів правильно
// налаштовані згідно з потребами вашого додатку або сервісу!

try {
    $config = Config::getInstance();
    // Прописываем конфиг
    $config->setBaseUri('https://fc-pay.gerc.ua');
    $config->setPartnerId('4');
    $config->setPartnerKey('12345');

    $payData = (new PayData())
        ->setPointId('42')
        ->setAmount('100')
        ->setDescription('testdescr1')
        ->setExtraParams("ewog12222zEyMyIKfQ==")
        ->setPayer("Петров П.П.");

    $constructGetIDBody = (new ConstructCommonGetIDBody())
        ->setPartnerId('4')
        ->setOperType(ConstructCommonGetIDBody::OPER_TYPE_HOLD)
        ->addPaydata($payData)
        ->addPaydata($payData);

    $request = (new CommonGetID());
    $request->setRequestBody($constructGetIDBody);
    $request->signature();

    echo "\n\n";
    print_r($request->getRequestBodyJson());
    $request->send();
    $response = $request->getResponseStringJson();

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
