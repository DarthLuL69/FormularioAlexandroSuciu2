window.onload = function() {
    const cuerpoTablaUsuarios = document.getElementById('userTable').getElementsByTagName('tbody')[0];
    const inputFiltro = document.getElementById('filterInput');

    async function cargarUsuarios() {
        try {
            const response = await fetch('ws/getUsuarios.php');
            const result = await response.json();
            if (result.success) {
                llenarTabla(result.usuarios);
            } else {
                Swal.fire('Error', result.message, 'error');
            }
        } catch (error) {
            Swal.fire('Error', 'No se pudieron cargar los usuarios', 'error');
        }
    }

    function llenarTabla(datos) {
        cuerpoTablaUsuarios.innerHTML = '';
        datos.forEach((usuario, indice) => {
            const fila = document.createElement('tr');
            fila.innerHTML = `
                <td>${usuario.nombre}</td>
                <td>${usuario.apellidos}</td>
                <td>${usuario.telefono}</td>
                <td>${usuario.email}</td>
                <td>${usuario.sexo}</td>
                <td>${usuario.direccion}</td>
                <td>
                    <button class="botonEditar" data-index="${indice}">Editar</button>
                    <button class="botonEliminar" data-index="${indice}">X</button>
                </td>
            `;
            cuerpoTablaUsuarios.appendChild(fila);
        });

        document.querySelectorAll('.botonEliminar').forEach(boton => {
            boton.onclick = async function() {
                const indice = this.dataset.index;
                const usuario = datos[indice];
                const result = await Swal.fire({
                    title: '¿Estás seguro?',
                    text: `¿Quieres eliminar a ${usuario.nombre} ${usuario.apellidos}?`,
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: 'Sí, eliminar',
                    cancelButtonText: 'Cancelar'
                });
                if (result.isConfirmed) {
                    try {
                        await fetch(`ws/deleteUser.php?id=${usuario.id}`, { method: 'DELETE' });
                        Swal.fire('Eliminado', 'El usuario ha sido eliminado', 'success');
                        cargarUsuarios();
                    } catch (error) {
                        Swal.fire('Error', 'No se pudo eliminar el usuario', 'error');
                    }
                }
            };
        });

        document.querySelectorAll('.botonEditar').forEach(boton => {
            boton.onclick = function() {
                const indice = this.dataset.index;
                mostrarFormularioEdicion(datos[indice], indice);
            };
        });
    }

    function filtrarTabla() {
        const textoFiltro = inputFiltro.value.toLowerCase();
        const datosFiltrados = textoFiltro.length < 3 ? usuarios : usuarios.filter(usuario =>
            usuario.nombre.toLowerCase().includes(textoFiltro) ||
            usuario.apellidos.toLowerCase().includes(textoFiltro)
        );
        llenarTabla(datosFiltrados);
    }

    function mostrarFormularioEdicion(usuario, indice) {
        const formularioExistente = document.getElementById('editForm');
        if (formularioExistente) {
            formularioExistente.remove();
        }

        const formularioHtml = `
            <form id="editForm" style="box-shadow: none; margin: 20px auto; max-width: 500px;">
                <label for="editNombre">Nombre:</label><br>
                <input type="text" id="editNombre" name="nombre" value="${usuario.nombre}"><br><br>
                <label for="editApellidos">Apellidos:</label><br>
                <input type="text" id="editApellidos" name="apellidos" value="${usuario.apellidos}"><br><br>
                <label for="editTelefono">Teléfono:</label><br>
                <input type="tel" id="editTelefono" name="telefono" value="${usuario.telefono}"><br><br>
                <label for="editEmail">Email:</label><br>
                <input type="email" id="editEmail" name="email" value="${usuario.email}"><br><br>
                <label for="editDireccion">Dirección:</label><br>
                <input type="text" id="editDireccion" name="direccion" value="${usuario.direccion}"><br><br>
                <label>Sexo:</label><br>
                <input type="radio" id="editHombre" name="sexo" value="Hombre" ${usuario.sexo === 'Hombre' ? 'checked' : ''}>
                <label for="editHombre">Hombre</label><br>
                <input type="radio" id="editMujer" name="sexo" value="Mujer" ${usuario.sexo === 'Mujer' ? 'checked' : ''}>
                <label for="editMujer">Mujer</label><br><br>
                <button type="button" onclick="guardarEdicion(${indice})">Guardar</button>
                <button type="button" onclick="cancelarEdicion()">Cancelar</button>
            </form>
        `;
        document.body.insertAdjacentHTML('beforeend', formularioHtml);
    }

    window.guardarEdicion = async function(indice) {
        const formulario = document.getElementById('editForm');
        const usuario = {
            id: formulario.id.value,
            nombre: formulario.nombre.value,
            apellidos: formulario.apellidos.value,
            telefono: formulario.telefono.value,
            email: formulario.email.value,
            sexo: formulario.sexo.value,
            direccion: formulario.direccion.value
        };
        try {
            await fetch(`ws/updateUser.php?id=${usuario.id}`, {
                method: 'POST',
                body: JSON.stringify(usuario),
                headers: { 'Content-Type': 'application/json' }
            });
            Swal.fire('Actualizado', 'El usuario ha sido actualizado', 'success');
            cargarUsuarios();
            formulario.remove();
        } catch (error) {
            Swal.fire('Error', 'No se pudo actualizar el usuario', 'error');
        }
    };

    window.cancelarEdicion = function() {
        const formulario = document.getElementById('editForm');
        if (formulario) {
            formulario.remove();
        }
    };

    cargarUsuarios();
    inputFiltro.oninput = filtrarTabla;
};