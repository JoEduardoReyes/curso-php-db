<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static PaymentMethodEnum CREDIT_CARD()
 * @method static PaymentMethodEnum BANK_ACCOUNT()
 */
class PaymentMethodEnum extends Enum
{
  private const CREDIT_CARD = 1;
  private const BANK_ACCOUNT = 2;

  private const CASH = 3;

  public function getDescription(): string
  {
    switch ($this->value) {
      case self::CREDIT_CARD:
        return 'Tarjeta de Crédito';
      case self::BANK_ACCOUNT:
        return 'Cuenta Bancaria';
      case self::CASH:
        return 'Efectivo';
      default:
        return 'Desconocido';
    }
  }
}