<?php
$pdo = require 'database.php';

$id = $_GET['id'];

$stmt = $pdo->prepare("DELETE FROM tbl_product WHERE id = ?");
$stmt->execute([$id]);

header("Location: index.php");
exit;
?>
