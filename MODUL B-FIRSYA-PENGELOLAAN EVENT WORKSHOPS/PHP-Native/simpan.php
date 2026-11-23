<?php
include "koneksi.php";

if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
    header("Location: index.php");
    exit;
}

$nama       = trim($_POST['nama'] ?? '');
$keahlian   = trim($_POST['keahlian'] ?? '');
$institusi  = trim($_POST['institusi'] ?? '');
$portofolio = trim($_POST['portofolio'] ?? '');

if ($nama === '' || $keahlian === '' || $institusi === '') {
    die("Nama, keahlian, dan institusi wajib diisi. <a href='index.php'>Kembali</a>");
}
if ($portofolio !== '' && !filter_var($portofolio, FILTER_VALIDATE_URL)) {
    die("URL portofolio tidak valid. <a href='index.php'>Kembali</a>");
}

$stmt = mysqli_prepare($conn, "INSERT INTO pembicara (nama, keahlian, institusi, portofolio) VALUES (?, ?, ?, ?)");
mysqli_stmt_bind_param($stmt, "ssss", $nama, $keahlian, $institusi, $portofolio);
mysqli_stmt_execute($stmt);

header("Location: index.php?pesan=" . urlencode("Data berhasil ditambahkan."));