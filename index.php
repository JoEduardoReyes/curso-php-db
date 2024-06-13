<?php

use App\Controllers\WithdrawalsController;
use App\Enums\PaymentMethodEnum;
use App\Enums\WithdrawalTypeEnum;

require("vendor/autoload.php");

//$incomes_controller = new IncomesController();
//$incomes_controller->store([
//  "payment_method" => PaymentMethodEnum::BankAccount->value,
//  "type" => IncomeTypeEnum::Salary->value,
//  "date" => date("Y-m-d H:i:s"), // 2022-06-24 15:06:45
////  "amount" => 84351,
//  "description" => "Pago de mi salario por mi arduo y muy bien trabajo :D"
//]);

$withdraw_controller = new WithdrawalsController();
$withdraw_controller->store([
  ":payment_method" => PaymentMethodEnum::CreditCard->value,
  ":type" => WithdrawalTypeEnum::Purchase->value,
  ":date" => date("Y-m-d H:i:s"),
  ":amount" => 20,
  ":description" => "Compre mucha comida para mis michis"
]);