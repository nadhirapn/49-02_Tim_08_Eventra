<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = (int)($_POST['id'] ?? 0);
    $stmt = mysqli_prepare($conn, "DELETE FROM pembicara WHERE id_pembicara=?");
    mysqli_stmt_bind_param($stmt, "i", $id);
    mysqli_stmt_execute($stmt);
    header("Location: index.php?pesan=" . urlencode("Data berhasil dihapus."));
    exit;
}
header("Location: index.php");