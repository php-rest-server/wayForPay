## WayForPay payment gateway integration for PHP-REST-Server

### Install
add to configuration file in section modules
```php
'modules' => [
    'wayForPay' => [
        'class' => RestCore\WayForPay\WayForPay::class,
        'merchantAccount' => 'test_merchant',
        'merchantAuthType' => 'SimpleSignature',
        'merchantDomainName' => 'test.com',
        'secretKey' => 'dhkq3vUi94{Z!5frxs(02ML',
        'language' => \RestCore\WayForPay\Interfaces\WayForPayConstants::LANGUAGE_AUTO,
        'returnUrl' => '',
        'serviceUrl' => '',
    ],
],
```
### Methods

