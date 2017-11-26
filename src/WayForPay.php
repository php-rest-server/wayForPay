<?php
/**
 * WayForPay payment gate integration module
 */

namespace RestCore\WayForPay;

use RestCore\Core\General\BaseModule;
use RestCore\Core\General\Param;
use RestCore\WayForPay\Interfaces\WayForPayConstants;

/**
 * Class WayForPay
 * @package RestCore\WayForPay
 */
class WayForPay extends BaseModule
{
    /**
     * Prepare post data for form
     *
     * @param $orderReference
     * @param $orderDate
     * @param $amount
     * @param $currency
     * @param array $productName
     * @param array $productCount
     * @param array $productPrice
     * @param string $clientAccountId
     * @param string $alternativeAmount
     * @param string $alternativeCurrency
     * @param string $type merchantTransactionType
     * @param int $holdTimeout
     * @param int $orderTimeout
     * @param int $orderLifetime
     * @param string $recToken
     * @param string $regularMode
     * @param string $regularAmount
     * @param string $dateNext
     * @param string $dateEnd
     * @param array $paymentSystems
     * @param string $defaultPaymentSystem
     */
    public function preparePurchasePostData(
        $orderReference,
        $orderDate,
        $amount,
        $currency,
        array $productName,
        array $productCount,
        array $productPrice,
        $clientAccountId = '',
        $alternativeAmount = '',
        $alternativeCurrency = '',
        $type = '',
        $holdTimeout = 0,
        $orderTimeout = 0,
        $orderLifetime = 0,
        $recToken = '',
        $regularMode = '',
        $regularAmount = '',
        $dateNext = '',
        $dateEnd = '',
        array $paymentSystems = [],
        $defaultPaymentSystem = ''
    )
    {
        $config = new Param($this->getConfig());

        $postData = [];

        $postData['merchantAccount'] = $config->get('merchantAccount', '');
        $postData['merchantAuthType'] = $config->get(
            'merchantAuthType',
            WayForPayConstants::MERCHANT_AUTH_TYPE_SIMPLE_SIGNATURE
        );

        $postData['merchantDomainName'] = $config->get('merchantDomainName', $_SERVER['HTTP_HOST']);
        if (!empty($type)) {
            $postData['merchantTransactionType'] = $type;
        }
        $postData['merchantTransactionSecureType'] = 'AUTO';
        $postData['language'] = $config->get('language', WayForPayConstants::LANGUAGE_AUTO);
        $postData['returnUrl'] = $config->get('returnUrl', '');
        $postData['serviceUrl'] = $config->get('serviceUrl', '');
        $postData['orderReference'] = $orderReference;

        if (!empty($alternativeAmount)) {
            $postData['alternativeAmount'] = $alternativeAmount;
        }
        if (!empty($alternativeCurrency)) {
            $postData['alternativeCurrency'] = $alternativeCurrency;
        }
        if (!empty($holdTimeout)) {
            $postData['holdTimeout'] = $holdTimeout;
        }
        if (!empty($orderTimeout)) {
            $postData['orderTimeout'] = $orderTimeout;
        }
        if (!empty($orderLifetime)) {
            $postData['orderLifetime'] = $orderLifetime;
        }
        if (!empty($recToken)) {
            $postData['recToken'] = $recToken;
        }
        if (!empty($clientAccountId)) {
            $postData['clientAccountId'] = $clientAccountId;
        }

        $postData['productName'] = $productName;
        $postData['productCount'] = $productCount;
        $postData['productPrice'] = $productPrice;

        if (!empty($regularMode)) {
            $postData['regularMode'] = $regularMode;
        }
        if (!empty($regularAmount)) {
            $postData['regularAmount'] = $regularAmount;
        }
        if (!empty($dateNext)) {
            $postData['dateNext'] = $dateNext;
        }
        if (!empty($dateEnd)) {
            $postData['dateEnd'] = $dateEnd;
        }
        if (!empty($paymentSystems)) {
            $postData['paymentSystems'] = implode(';', $paymentSystems);
        }
        if (!empty($defaultPaymentSystem)) {
            $postData['defaultPaymentSystem'] = $defaultPaymentSystem;
        }

        $postData['merchantSignature'] = $this->calcSignature(
            $orderReference,
            $orderDate,
            $amount,
            $currency,
            $productName,
            $productCount,
            $productPrice
        );

        return $postData;
    }


    /**
     * Calculate signature
     *
     * @param int/string $orderReference
     * @param string $orderDate
     * @param float $amount
     * @param string $currency
     * @param array $productName
     * @param array $productCount
     * @param array $productPrice
     * @return string signature
     */
    public function calcSignature(
        $orderReference,
        $orderDate,
        $amount,
        $currency,
        array $productName,
        array $productCount,
        array $productPrice
    )
    {
        $config = new Param($this->getConfig());
        $parts = [
            $config->get('merchantAccount', ''),
            $config->get('merchantDomainName', $_SERVER['HTTP_HOST']),
            $orderReference,
            $orderDate,
            $amount,
            $currency,
        ];
        $parts = array_merge($parts, $productName, $productCount, $productPrice);

        return hash_hmac('md5', implode(';', $parts), $config->get('secretKey', ''));
    }
}
