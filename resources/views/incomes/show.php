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

    <!-- Botón para eliminar -->
    <button class="delete-button" onclick="confirmAndDelete(<?= $income['id'] ?>)">Eliminar</button>

    <a class="back-link" href="/incomes">Volver a la lista de ingresos</a>

</main>

<script>
    function confirmAndDelete(id) {
        if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
            // Crear una solicitud DELETE utilizando fetch API
            fetch(`/incomes/${id}`, {
                method: 'DELETE',
                headers: {
                    'Content-Type': 'application/json'
                },
            })
                .then(response => {
                    if (response.ok) {
                        console.log('Registro eliminado correctamente.');
                        // Redirigir a la lista de ingresos u otra página si es necesario
                        window.location.href = '/incomes';
                    } else {
                        console.error('Error al eliminar el registro.');
                        response.text().then(text => {
                            console.error('Error details:', text);
                        });
                    }
                })
                .catch(error => {
                    console.error('Error en la solicitud:', error);
                });
        }
    }
</script>

</body>
</html>
