<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/css/styles.css">
    <link rel="stylesheet" href="/css/create.css">
    <title>Agrega nuevo ingreso</title>
</head>
<body>
<h1>Agrega un nuevo Ingreso</h1>
<main>
    <form action="/incomes" method="post" id="income-form">

        <div class="input-group">
            <label for="payment_method" class="label">Método de pago</label>
            <select name="payment_method" id="payment_method" class="form-control">
                <option value="1" selected>Cuenta bancaria</option>
                <option value="2">Tarjeta de crédito</option>
            </select>
        </div>

        <div class="input-group">
            <label for="type" class="label">Tipo de ingreso</label>
            <select name="type" id="type" class="form-control">
                <option value="1" selected>Pago de nómina</option>
                <option value="2">Reembolso</option>
            </select>
        </div>

        <div class="input-group">
            <label for="date" class="label">Fecha</label>
            <input type="date" name="date" id="date" class="form-control">
            <label for="time" class="label">Hora</label>
            <input type="time" name="time" id="time" class="form-control">
        </div>

        <div class="input-group">
            <label for="amount" class="label">Monto</label>
            <input type="number" name="amount" id="amount" class="form-control" value="0" step="0.01">
        </div>

        <div class="input-group">
            <label for="description" class="label">Descripción</label>
            <textarea name="description" id="description" class="form-control"></textarea>
        </div>

        <input type="hidden" name="method" value="post">

        <div class="button-container">
            <button class="button-link" type="submit">Guardar</button>
        </div>

    </form>
    <a href="/incomes" class="button-link">Volver a la lista</a>
</main>

<script>
    document.getElementById('income-form').addEventListener('submit', function(event) {
        event.preventDefault();  // Prevenir el envío por defecto del formulario

        let dateInput = document.getElementById('date').value;
        let timeInput = document.getElementById('time').value;

        // Asegúrate de que ambos campos están llenos
        if (dateInput && timeInput) {
            let formattedDate = `${dateInput} ${timeInput}:00`;

            // Crear un nuevo campo de entrada oculto para la fecha y la hora combinadas
            let hiddenDateTimeInput = document.createElement('input');
            hiddenDateTimeInput.type = 'hidden';
            hiddenDateTimeInput.name = 'datetime';
            hiddenDateTimeInput.value = formattedDate;

            // Agregar el nuevo campo al formulario
            document.getElementById('income-form').appendChild(hiddenDateTimeInput);

            // Enviar el formulario
            document.getElementById('income-form').submit();
        } else {
            alert('Por favor, ingrese tanto la fecha como la hora.');
        }
    });
</script>

</body>
</html>
