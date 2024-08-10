<?php

namespace App\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static IncomeTypeEnum SALARY()
 * @method static IncomeTypeEnum REFUND()
 */
class IncomeTypeEnum extends Enum
{
  private const SALARY = 1;
  private const REFUND = 2;

  private const PAYMENT = 3;

  private const FREELANCE = 4;

  public function getDescription(): string
  {
    switch ($this->value) {
      case self::SALARY:
        return 'Salario';
      case self::REFUND:
        return 'Reembolso';
      case self::PAYMENT:
        return 'Pago';
      case self::FREELANCE:
        return 'Freeance';
      default:
        return 'Desconocido';
    }
  }
}