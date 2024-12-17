document.getElementById('userForm').onsubmit = async function(event) {
    event.preventDefault();
    const formData = new FormData(this);
    const result = await Swal.fire({
        title: '¿Estás seguro?',
        text: '¿Quieres crear este usuario?',
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Sí, crear',
        cancelButtonText: 'Cancelar'
    });
    if (result.isConfirmed) {
        try {
            const response = await fetch('ws/crearUsuario2.php', {
                method: 'POST',
                body: formData
            });
            const result = await response.json();
            if (result.success) {
                Swal.fire('Éxito', 'Usuario creado con éxito', 'success');
                this.reset();
            } else {
                Swal.fire('Error', result.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'No se pudo crear el usuario', 'error');
        }
    }
};
