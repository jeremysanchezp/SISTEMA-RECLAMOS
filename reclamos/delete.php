<?php
include '../config/db.php';
$id = $_GET['id'];
$conn->prepare("DELETE FROM reclamos WHERE id=?")->execute([$id]);
header("Location: index.php");
