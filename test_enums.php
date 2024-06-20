<?php

// Cargar el autoload de Composer para cargar automáticamente las clases
require __DIR__ . '/vendor/autoload.php';

use App\Enums\IncomeTypeEnum;
use App\Enums\PaymentMethodEnum;

// Ejemplo de uso de los enums y sus métodos de descripción
$incomeType = IncomeTypeEnum::SALARY();
$paymentMethod = PaymentMethodEnum::CREDIT_CARD();

// Obtener la descripción de los enums y mostrarlas
$incomeTypeDescription = $incomeType->getDescription();
$paymentMethodDescription = $paymentMethod->getDescription();

echo "Descripción del tipo de ingreso {$incomeType->getValue()}: {$incomeTypeDescription}" . PHP_EOL;
echo "Descripción del método de pago {$paymentMethod->getValue()}: {$paymentMethodDescription}" . PHP_EOL;
