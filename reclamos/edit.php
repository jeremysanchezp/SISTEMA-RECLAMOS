<?php
include '../config/db.php';
$id = $_GET['id'];
$reclamo = $conn->query("SELECT * FROM reclamos WHERE id = $id")->fetch();
$clientes = $conn->query("SELECT * FROM clientes")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST["asunto"];
    $descripcion = $_POST["descripcion"];
    $id_cliente = $_POST["id_cliente"];

    if ($_FILES["evidencia"]["name"]) {
        $evidencia = $_FILES["evidencia"]["name"];
        move_uploaded_file($_FILES["evidencia"]["tmp_name"], "../uploads/" . $evidencia);
    } else {
        $evidencia = $reclamo['evidencia'];
    }

    $sql = "UPDATE reclamos SET asunto=?, descripcion=?, evidencia=?, id_cliente=? WHERE id=?";
    $conn->prepare($sql)->execute([$asunto, $descripcion, $evidencia, $id_cliente, $id]);

    header("Location: index.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    Asunto: <input type="text" name="asunto" value="<?= $reclamo['asunto'] ?>"><br>
    Descripción: <textarea name="descripcion"><?= $reclamo['descripcion'] ?></textarea><br>
    Cliente:
    <select name="id_cliente">
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>" <?= $c['id'] == $reclamo['id_cliente'] ? 'selected' : '' ?>><?= $c['nombre'] ?></option>
        <?php endforeach; ?>
    </select><br>
    Evidencia: <input type="file" name="evidencia"><br>
    <img src="../uploads/<?= $reclamo['evidencia'] ?>" width="50"><br>
    <button type="submit">Actualizar</button>
</form>