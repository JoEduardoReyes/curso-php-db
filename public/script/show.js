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

    let formData = new FormData(this);
    formData.append('_method', 'put'); // Agregar el campo _method con valor put

    fetch(`/incomes/${formData.get('id')}`, {
        method: 'POST', // Usar POST en lugar de PUT
        body: formData
    })
        .then(response => {
            if (response.ok) {
                console.log('Registro actualizado correctamente.');
                window.location.href = '/incomes'; // Redirigir a la lista de ingresos
            } else {
                console.error('Error al actualizar el registro.');
                response.text().then(text => {
                    console.error('Detalles del error:', text);
                });
            }
        })
        .catch(error => {
            console.error('Error en la solicitud:', error);
        });
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
