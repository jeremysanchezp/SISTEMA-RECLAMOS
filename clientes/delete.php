<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->prepare("DELETE FROM clientes WHERE id=?")->execute([$id]);
header("Location: index.php");
