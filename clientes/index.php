<?php
include '../config/db.php';
$clientes = $conn->query("SELECT * FROM clientes")->fetchAll();
?>

<a href="create.php">Nuevo Cliente</a>
<h2>Lista de Clientes</h2>
<table border="1">
    <tr>
        <th>Nombre</th>
        <th>Correo</th>
        <th>Teléfono</th>
        <th>Foto</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($clientes as $c): ?>
        <tr>
            <td><?= $c['nombre'] ?></td>
            <td><?= $c['correo'] ?></td>
            <td><?= $c['telefono'] ?></td>
            <td><img src="../uploads/<?= $c['foto_perfil'] ?>" width="50"></td>
            <td>
                <a href="edit.php?id=<?= $c['id'] ?>">Editar</a> |
                <a href="delete.php?id=<?= $c['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>