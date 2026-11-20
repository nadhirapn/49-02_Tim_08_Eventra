<?php
include 'koneksi.php';

$id        = (int) $_POST['id'];
$nama      = mysqli_real_escape_string($conn, $_POST['nama']);
$nim       = mysqli_real_escape_string($conn, $_POST['nim']);
$instansi  = mysqli_real_escape_string($conn, $_POST['instansi']);
$no_kontak = mysqli_real_escape_string($conn, $_POST['no_kontak']);
$email     = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "UPDATE peserta SET nama='$nama', nim='$nim', instansi='$instansi',
        no_kontak='$no_kontak', email='$email' WHERE id=$id";

if (mysqli_query($conn, $sql)) {
    header("Location: data-peserta.php");
    exit;
} else {
    echo "Gagal update: " . mysqli_error($conn);
}
?>