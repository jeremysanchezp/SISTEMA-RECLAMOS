<?php
include '../config/db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];
    $foto = $_FILES["foto_perfil"]["name"];
    move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], "../uploads/" . $foto);

    $sql = "INSERT INTO clientes (nombre, correo, telefono, foto_perfil) VALUES (?, ?, ?, ?)";
    $conn->prepare($sql)->execute([$nombre, $correo, $telefono, $foto]);

    header("Location: index.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre"><br>
    Correo: <input type="email" name="correo"><br>
    Teléfono: <input type="text" name="telefono"><br>
    Foto: <input type="file" name="foto_perfil"><br>
    <button type="submit">Guardar</button>
</form>
