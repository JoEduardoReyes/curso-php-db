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

    <table>
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
        <?php
        // Importamos los enums necesarios
        use App\Enums\PaymentMethodEnum;
        use App\Enums\IncomeTypeEnum;

        foreach ($results as $result): ?>
            <tr>
                <td><?php echo PaymentMethodEnum::from($result["payment_method"])->getDescription(); ?></td>
                <td><?php echo IncomeTypeEnum::from($result["type"])->getDescription(); ?></td>
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

</body>
</html>
