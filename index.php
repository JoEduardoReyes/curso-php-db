<?php

use App\Controllers\IncomesController;
use App\Enums\IncomeTypeEnum;
use App\Controllers\WithdrawalsController;
use App\Enums\WithdrawalTypeEnum;
use App\Enums\PaymentMethodEnum;

require("vendor/autoload.php");

//$incomes_controller = new IncomesController();
//
//// Definir los datos a insertar
//$data = [
//  "payment_method" => PaymentMethodEnum::BankAccount->value,
//  "type" => IncomeTypeEnum::Salary->value,
//  "date" => date("Y-m-d H:i:s"),
//  "amount" => 665684,
//  "description" => "Pago de mi salario por mi arduo y muy bien trabajo :D"
//];
//
//// Llamar al método store para insertar los datos
//$incomes_controller->store($data);

//$withdraw_controller = new WithdrawalsController();
//$withdraw_controller->store([
//  "payment_method" => PaymentMethodEnum::CreditCard->value,
//  "type" => WithdrawalTypeEnum::Purchase->value,
//  "date" => date("Y-m-d H:i:s"),
//  "amount" => 50,
//  "description" => "Juguetitos para mis michis"
//]);

//$withdrawalController = new WithdrawalsController();
//$withdrawalController->show(1);

//$incomes_controller = new IncomesController();
//$incomes_controller->index();

$incomes_controlles = new IncomesController();
$incomes_controlles->show(1);