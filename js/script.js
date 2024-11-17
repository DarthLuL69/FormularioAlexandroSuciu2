window.onload = function() {
    const userTableBody = document.getElementById('userTable').getElementsByTagName('tbody')[0];
    const filterInput = document.getElementById('filterInput');

    const users = [
        { nombre: 'Juan', apellidos: 'Pérez', telefono: '123456789', email: 'juan.perez@example.com', sexo: 'Hombre', address: 'Calle Falsa 123' },
        { nombre: 'María', apellidos: 'Gómez', telefono: '987654321', email: 'maria.gomez@example.com', sexo: 'Mujer', address: 'Avenida Siempre Viva 742' },
        { nombre: 'Carlos', apellidos: 'Rodríguez', telefono: '555555555', email: 'carlos.rodriguez@example.com', sexo: 'Hombre', address: 'Plaza Mayor 1' },
        { nombre: 'Ana', apellidos: 'López', telefono: '444444444', email: 'ana.lopez@example.com', sexo: 'Mujer', address: 'Calle del Sol 45' }
    ];

    function fillTable(data) {
        userTableBody.innerHTML = '';
        data.forEach((user, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${user.nombre}</td>
                <td>${user.apellidos}</td>
                <td>${user.telefono}</td>
                <td>${user.email}</td>
                <td>${user.sexo}</td>
                <td>${user.address}</td>
                <td>
                    <button class="editButton" data-index="${index}">Editar</button>
                    <button class="deleteButton">X</button>
                </td>
            `;
            userTableBody.appendChild(row);
        });

        const deleteButtons = document.getElementsByClassName('deleteButton');
        Array.from(deleteButtons).forEach(button => {
            button.onclick = function() {
                this.parentElement.parentElement.remove();
            };
        });

        const editButtons = document.getElementsByClassName('editButton');
        Array.from(editButtons).forEach(button => {
            button.onclick = function() {
                const index = this.getAttribute('data-index');
                const user = users[index];
                showEditForm(user, index);
            };
        });
    }

    function filterTable() {
        const filterText = filterInput.value.toLowerCase();
        if (filterText.length < 3) {
            fillTable(users);
            return;
        }

        const filteredData = users.filter(user =>
            user.nombre.toLowerCase().includes(filterText) ||
            user.apellidos.toLowerCase().includes(filterText)
        );

        fillTable(filteredData);
    }

    function showEditForm(user, index) {
        const formHtml = `
            <form id="editForm">
                <label for="editNombre">Nombre:</label><br>
                <input type="text" id="editNombre" name="nombre" value="${user.nombre}"><br><br>
                <label for="editApellidos">Apellidos:</label><br>
                <input type="text" id="editApellidos" name="apellidos" value="${user.apellidos}"><br><br>
                <label for="editTelefono">Teléfono:</label><br>
                <input type="tel" id="editTelefono" name="telefono" value="${user.telefono}"><br><br>
                <label for="editEmail">Email:</label><br>
                <input type="email" id="editEmail" name="email" value="${user.email}"><br><br>
                <label for="editAddress">Dirección:</label><br>
                <input type="text" id="editAddress" name="address" value="${user.address}"><br><br>
                <label>Sexo:</label><br>
                <input type="radio" id="editHombre" name="sexo" value="Hombre" ${user.sexo === 'Hombre' ? 'checked' : ''}>
                <label for="editHombre">Hombre</label><br>
                <input type="radio" id="editMujer" name="sexo" value="Mujer" ${user.sexo === 'Mujer' ? 'checked' : ''}>
                <label for="editMujer">Mujer</label><br><br>
                <button type="button" onclick="saveEdit(${index})">Guardar</button>
            </form>
        `;
        document.body.insertAdjacentHTML('beforeend', formHtml);
    }

    window.saveEdit = function(index) {
        const form = document.getElementById('editForm');
        const updatedUser = {
            nombre: form.nombre.value,
            apellidos: form.apellidos.value,
            telefono: form.telefono.value,
            email: form.email.value,
            sexo: form.sexo.value,
            address: form.address.value
        };
        users[index] = updatedUser;
        fillTable(users);
        form.remove();
    };

    fillTable(users);
    filterInput.oninput = filterTable;
};