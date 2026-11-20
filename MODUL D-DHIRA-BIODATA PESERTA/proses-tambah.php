<?php
include 'koneksi.php';

$nama      = mysqli_real_escape_string($conn, $_POST['nama']);
$nim       = mysqli_real_escape_string($conn, $_POST['nim']);
$instansi  = mysqli_real_escape_string($conn, $_POST['instansi']);
$no_kontak = mysqli_real_escape_string($conn, $_POST['no_kontak']);
$email     = mysqli_real_escape_string($conn, $_POST['email']);

$sql = "INSERT INTO peserta (nama, nim, instansi, no_kontak, email)
        VALUES ('$nama', '$nim', '$instansi', '$no_kontak', '$email')";

if (mysqli_query($conn, $sql)) {
    header("Location: data-peserta.php");
exit;
} else {
    echo "Gagal menyimpan: " . mysqli_error($conn);
}
?> 