<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/index.css">
    <title>Lista de ingresos</title>
</head>
<body>

<h1>Lista de ingresos</h1>

<main>

    <table id="income-table">
        <thead>
        <tr>
            <th>Método de pago</th>
            <th>Tipo de ingreso</th>
            <th>Fecha</th>
            <th>Monto</th>
            <th>Descripción</th>
            <th>Acciones</th> <!-- Agregamos esta columna para los enlaces de detalles -->
        </tr>
        </thead>
        <tbody>
        <?php foreach ($results as $result): ?>
            <tr>
                <td class="payment-method"><?php echo htmlspecialchars($result["payment_method"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="income-type"><?php echo htmlspecialchars($result["type"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($result["date"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($result["amount"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td><?php echo htmlspecialchars($result["description"], ENT_QUOTES, 'UTF-8'); ?></td>
                <td class="table-actions">
                    <a href="/incomes/<?php echo $result['id']; ?>">Ver detalles</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>

    <a class="button-link" href="/incomes/create">Agregar nuevo ingreso</a>

</main>

<script>
    // JavaScript para transformar valores numéricos a descripciones
    const paymentMethodEnum = {
        1: 'Tarjeta de crédito',
        2: 'Cuenta bancaria'
        // Añade más valores según tus enums PHP
    };

    const incomeTypeEnum = {
        1: 'Pago de nómina',
        2: 'Reembolso'
        // Añade más valores según tus enums PHP
    };

    document.addEventListener('DOMContentLoaded', () => {
        const rows = document.querySelectorAll('#income-table tbody tr');
        rows.forEach(row => {
            const paymentMethodCell = row.querySelector('.payment-method');
            const incomeTypeCell = row.querySelector('.income-type');

            const paymentMethodValue = parseInt(paymentMethodCell.textContent.trim());
            const incomeTypeValue = parseInt(incomeTypeCell.textContent.trim());

            paymentMethodCell.textContent = paymentMethodEnum[paymentMethodValue] || 'Desconocido';
            incomeTypeCell.textContent = incomeTypeEnum[incomeTypeValue] || 'Desconocido';
        });
    });
</script>

</body>
</html>
