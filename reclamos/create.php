<?php
include '../config/db.php';
$clientes = $conn->query("SELECT * FROM clientes")->fetchAll();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $asunto = $_POST["asunto"];
    $descripcion = $_POST["descripcion"];
    $id_cliente = $_POST["id_cliente"];
    $evidencia = $_FILES["evidencia"]["name"];
    move_uploaded_file($_FILES["evidencia"]["tmp_name"], "../uploads/" . $evidencia);

    $sql = "INSERT INTO reclamos (asunto, descripcion, evidencia, id_cliente) VALUES (?, ?, ?, ?)";
    $conn->prepare($sql)->execute([$asunto, $descripcion, $evidencia, $id_cliente]);

    header("Location: index.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    Asunto: <input type="text" name="asunto"><br>
    Descripción: <textarea name="descripcion"></textarea><br>
    Cliente:
    <select name="id_cliente">
        <?php foreach ($clientes as $c): ?>
            <option value="<?= $c['id'] ?>"><?= $c['nombre'] ?></option>
        <?php endforeach; ?>
    </select><br>
    Evidencia: <input type="file" name="evidencia"><br>
    <button type="submit">Guardar</button>
</form>
