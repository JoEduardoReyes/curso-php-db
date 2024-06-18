<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/show.css">
    <title>Detalle de ingreso</title>
</head>
<body>

<h1>Detalle de ingreso</h1>

<main class="main-container">

    <div class="field-label">ID:</div>
    <div class="field-value"><?= $income['id'] ?></div>

    <div class="field-label">Método de pago:</div>
    <div class="field-value"><?= $income['payment_method'] ?></div>

    <div class="field-label">Tipo:</div>
    <div class="field-value"><?= $income['type'] ?></div>

    <div class="field-label">Fecha:</div>
    <div class="field-value"><?= $income['date'] ?></div>

    <div class="field-label">Monto:</div>
    <div class="field-value"><?= $income['amount'] ?></div>

    <div class="field-label">Descripción:</div>
    <div class="field-value"><?= $income['description'] ?></div>

    <a class="back-link" href="/incomes">Volver a la lista de ingresos</a>

</main>

</body>
</html>
