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

    <form id="income-details-form" action="/incomes/<?= $income['id'] ?>" method="post">
        <div class="field-label">ID:</div>
        <div class="field-value"><?= $income['id'] ?></div>

        <div class="input-group">
            <label for="payment_method" class="label">Método de pago:</label>
            <select name="payment_method" id="payment_method" class="form-control" disabled>
                <option value="1" <?= $income['payment_method'] == 1 ? 'selected' : '' ?>>Cuenta bancaria</option>
                <option value="2" <?= $income['payment_method'] == 2 ? 'selected' : '' ?>>Tarjeta de crédito</option>
            </select>
        </div>

        <div class="input-group">
            <label for="type" class="label">Tipo de ingreso:</label>
            <select name="type" id="type" class="form-control" disabled>
                <option value="1" <?= $income['type'] == 1 ? 'selected' : '' ?>>Pago de nómina</option>
                <option value="2" <?= $income['type'] == 2 ? 'selected' : '' ?>>Reembolso</option>
            </select>
        </div>

        <div class="input-group">
            <label for="date" class="label">Fecha:</label>
            <input type="date" name="date" id="date" class="form-control" value="<?= date('Y-m-d', strtotime($income['date'])) ?>" disabled>
            <label for="time" class="label">Hora:</label>
            <input type="time" name="time" id="time" class="form-control" value="<?= date('H:i', strtotime($income['date'])) ?>" disabled>
        </div>

        <div class="input-group">
            <label for="amount" class="label">Monto:</label>
            <input type="number" name="amount" id="amount" class="form-control" value="<?= $income['amount'] ?>" step="0.01" disabled>
        </div>

        <div class="input-group">
            <label for="description" class="label">Descripción:</label>
            <textarea name="description" id="description" class="form-control" disabled><?= $income['description'] ?></textarea>
        </div>

        <input type="hidden" name="_method" value="put">
        <input type="hidden" name="id" value="<?= $income['id'] ?>">

        <div class="button-container">
            <button type="button" id="edit-button" class="button-link">Modificar</button>
            <button type="submit" id="save-button" class="button-link" style="display:none;">Guardar</button>
        </div>
    </form>

    <button onclick="confirmAndDelete(<?= $income['id'] ?>)">Eliminar</button>
    <a class="back-link" href="/incomes">Volver a la lista de ingresos</a>

</main>
<script src="/script/show.js"></script>

</body>
</html>
