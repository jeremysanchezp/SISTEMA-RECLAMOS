<?php
include '../config/db.php';
$id = $_GET['id'];
$cliente = $conn->query("SELECT * FROM clientes WHERE id = $id")->fetch();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST["nombre"];
    $correo = $_POST["correo"];
    $telefono = $_POST["telefono"];

    if ($_FILES["foto_perfil"]["name"]) {
        $foto = $_FILES["foto_perfil"]["name"];
        move_uploaded_file($_FILES["foto_perfil"]["tmp_name"], "../uploads/" . $foto);
    } else {
        $foto = $cliente['foto_perfil'];
    }

    $sql = "UPDATE clientes SET nombre=?, correo=?, telefono=?, foto_perfil=? WHERE id=?";
    $conn->prepare($sql)->execute([$nombre, $correo, $telefono, $foto, $id]);

    header("Location: index.php");
}
?>

<form method="POST" enctype="multipart/form-data">
    Nombre: <input type="text" name="nombre" value="<?= $cliente['nombre'] ?>"><br>
    Correo: <input type="email" name="correo" value="<?= $cliente['correo'] ?>"><br>
    Teléfono: <input type="text" name="telefono" value="<?= $cliente['telefono'] ?>"><br>
    Foto: <input type="file" name="foto_perfil"><br>
    <img src="../uploads/<?= $cliente['foto_perfil'] ?>" width="50"><br>
    <button type="submit">Actualizar</button>
</form>