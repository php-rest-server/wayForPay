<?php
/**
 * Constants which using in WayForPay api
 */

namespace RestCore\WayForPay\Interfaces;

/**
 * Interface WayForPayConstants
 * @package RestCore\WayForPay\Interfaces
 */
interface WayForPayConstants
{
    // urls

    const PAYMENT_URL = 'https://secure.wayforpay.com/pay';

    // merchant auth types

    const MERCHANT_AUTH_TYPE_SIMPLE_SIGNATURE = 'SimpleSignature';

    const MERCHANT_AUTH_TYPE_TICKET = 'ticket';

    const MERCHANT_AUTH_TYPE_PASSWORD = 'password';

    // merchant transaction types

    const MERCHANT_TRANSACTION_TYPE_AUTO = 'AUTO';

    const MERCHANT_TRANSACTION_TYPE_AUTH = 'AUTH';

    const MERCHANT_TRANSACTION_TYPE_SALE = 'SALE';

    // languages

    const LANGUAGE_AUTO = 'AUTO';

    const LANGUAGE_RU = 'RU';

    const LANGUAGE_UA = 'UA';

    const LANGUAGE_EN = 'EN';

    // currencies

    const CURRENCY_UAH = 'UAH';

    const CURRENCY_USD = 'USD';

    const CURRENCY_EUR = 'EUR';

    const CURRENCY_RUB = 'RUB';

    // payment systems

    const PAYMENT_SYSTEM_CARD = 'card';

    const PAYMENT_SYSTEM_PRIVAT24 = 'privat24';

    const PAYMENT_SYSTEM_LP_TERMINAL = 'lpTerminal';

    const PAYMENT_SYSTEM_BTC = 'btc';

    const PAYMENT_SYSTEM_CREDIT = 'credit';

    const PAYMENT_SYSTEM_PAY_PARTS = 'payParts';

    const PAYMENT_SYSTEM_QR_CODE = 'qrCode';

    // regular modes

    const REGULAR_MODE_NONE = 'none';

    const REGULAR_MODE_ONCE = 'once';

    const REGULAR_MODE_DAILY = 'daily';

    const REGULAR_MODE_WEEKLY = 'weekly';

    const REGULAR_MODE_QUARTERLY = 'quarterly';

    const REGULAR_MODE_MONTHLY = 'monthly';

    const REGULAR_MODE_HALF_YEARLY = 'halfyearly';

    const REGULAR_MODE_YEARLY = 'yearly';

    // statuses

    const STATUS_CREATED = 'Created';

    const STATUS_IN_PROCESSING = 'InProcessing';

    const STATUS_WAITING_AUTH_COMPLETE = 'WaitingAuthComplete';

    const STATUS_APPROVED = 'Approved';

    const STATUS_PENDING = 'Pending';

    const STATUS_EXPIRED = 'Expired';

    const STATUS_REFUNDED = 'Refunded';

    const STATUS_DECLINED = 'Declined';

    const STATUS_REFUND_IN_PROCESSING = 'RefundInProcessing';
}
