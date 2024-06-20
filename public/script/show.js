// show.js

document.getElementById('edit-button').addEventListener('click', function() {
    document.querySelectorAll('#income-details-form .form-control').forEach(element => {
        element.disabled = false;
    });
    document.getElementById('edit-button').style.display = 'none';
    document.getElementById('save-button').style.display = 'inline-block';
});

document.getElementById('income-details-form').addEventListener('submit', function(event) {
    event.preventDefault();

    // Obtener los valores de fecha y hora
    let dateValue = document.getElementById('date').value;
    let timeValue = document.getElementById('time').value;

    // Combinar fecha y hora en un solo campo datetime
    let datetimeValue = dateValue + ' ' + timeValue;

    // Actualizar el valor de los campos date y time
    document.getElementById('date').value = dateValue;
    document.getElementById('time').value = timeValue;

    // Deshabilitar los campos date y time para evitar edición accidental
    document.getElementById('date').disabled = true;
    document.getElementById('time').disabled = true;

    // Agregar un campo oculto para enviar datetime al servidor
    let hiddenDateTimeInput = document.createElement('input');
    hiddenDateTimeInput.type = 'hidden';
    hiddenDateTimeInput.name = 'datetime';
    hiddenDateTimeInput.value = datetimeValue;
    this.appendChild(hiddenDateTimeInput);

    // Habilitar el botón de guardar y deshabilitar el botón de editar
    document.getElementById('edit-button').style.display = 'inline-block';
    document.getElementById('save-button').style.display = 'none';

    // Enviar el formulario
    this.submit();
});

function confirmAndDelete(id) {
    if (confirm('¿Estás seguro de que deseas eliminar este registro?')) {
        fetch(`/incomes/${id}`, {
            method: 'DELETE',
            headers: {
                'Content-Type': 'application/json'
            },
        })
            .then(response => {
                if (response.ok) {
                    console.log('Registro eliminado correctamente.');
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
