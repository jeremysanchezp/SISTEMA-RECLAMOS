<?php
include '../config/db.php';
$reclamos = $conn->query("SELECT r.*, c.nombre FROM reclamos r JOIN clientes c ON r.id_cliente = c.id")->fetchAll();
?>

<a href="create.php">Nuevo Reclamo</a>
<h2>Lista de Reclamos</h2>
<table border="1">
    <tr>
        <th>Cliente</th>
        <th>Asunto</th>
        <th>Descripción</th>
        <th>Evidencia</th>
        <th>Acciones</th>
    </tr>
    <?php foreach ($reclamos as $r): ?>
        <tr>
            <td><?= $r['nombre'] ?></td>
            <td><?= $r['asunto'] ?></td>
            <td><?= $r['descripcion'] ?></td>
            <td><img src="../uploads/<?= $r['evidencia'] ?>" width="50"></td>
            <td>
                <a href="edit.php?id=<?= $r['id'] ?>">Editar</a> |
                <a href="delete.php?id=<?= $r['id'] ?>" onclick="return confirm('¿Eliminar?')">Eliminar</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>