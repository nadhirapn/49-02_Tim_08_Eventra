<?php
include "koneksi.php";

$id = (int)($_GET['id'] ?? 0);
$stmt = mysqli_prepare($conn, "SELECT * FROM pembicara WHERE id_pembicara=?");
mysqli_stmt_bind_param($stmt, "i", $id);
mysqli_stmt_execute($stmt);
$data = mysqli_fetch_assoc(mysqli_stmt_get_result($stmt));
if (!$data) {
    die("Data tidak ditemukan. <a href='index.php'>Kembali</a>");
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail &amp; Jadwal Sesi Pembicara</title>
    <link rel="stylesheet" href="CSS%20Hal%202.css">
</head>
<body>
    <p><a href="index.php"><button type="button">&larr; Kembali ke Halaman Utama</button></a></p>

    <h1>Detail &amp; Penjadwalan Sesi Pembicara</h1>
    <hr>

    <h2>Ringkasan Profil Narasumber</h2>
    <ul>
        <li><strong>Nama Narasumber:</strong> <?= e($data['nama']) ?></li>
        <li><strong>Profil Keahlian:</strong> <?= e($data['keahlian']) ?></li>
        <li><strong>Institusi:</strong> <?= e($data['institusi']) ?></li>
        <li><strong>Portofolio:</strong>
            <?php if ($data['portofolio']): ?>
                <a href="<?= e($data['portofolio']) ?>" target="_blank">Lihat Portofolio Lengkap</a>
            <?php else: ?>-<?php endif; ?>
        </li>
    </ul>
</body>
</html>