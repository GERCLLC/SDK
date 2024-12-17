# GERC SDK
# Версія 0.4, Бета, для ознайомлення

Встановлення останньої версії пакета
Install:
```shell
composer require gercllc/sdk
```

Реєстрація платежу:
https://github.com/GERCLLC/SDK/blob/main/example/getID.php

Оплата карткою, обов'язково використовувати в getID параметр setUserIp:
https://github.com/GERCLLC/SDK/blob/main/example/PaybyCard.php

Отримання статусу операції:
https://github.com/GERCLLC/SDK/blob/main/example/getStatus.php

Запит повернення коштів:
https://github.com/GERCLLC/SDK/blob/main/example/refund.php

Отримання квітанції:
https://github.com/GERCLLC/SDK/blob/main/example/getReceipt.php

# Test
```shell
./vendor/bin/phpunit --bootstrap ./vendor/autoload.php tests/CommonGetFreeTest.php
./vendor/bin/phpunit --bootstrap ./vendor/autoload.php tests/CommonGetIDAndGetStatusTest.php
./vendor/bin/phpunit --bootstrap ./vendor/autoload.php tests/CommonGetIDAndPaybyCardTest.php
```