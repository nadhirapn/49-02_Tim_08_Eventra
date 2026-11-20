<?php
include 'koneksi.php';

$id = (int) $_GET['id'];
mysqli_query($conn, "DELETE FROM peserta WHERE id=$id");

header("Location: data-peserta.php");
exit;
?>