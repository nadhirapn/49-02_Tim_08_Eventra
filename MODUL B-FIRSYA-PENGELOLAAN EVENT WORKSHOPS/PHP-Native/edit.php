<?php
include "koneksi.php";

$id = (int)($_GET['id'] ?? $_POST['id'] ?? 0);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama       = trim($_POST['nama'] ?? '');
    $keahlian   = trim($_POST['keahlian'] ?? '');
    $institusi  = trim($_POST['institusi'] ?? '');
    $portofolio = trim($_POST['portofolio'] ?? '');

    if ($nama === '' || $keahlian === '' || $institusi === '') {
        die("Nama, keahlian, dan institusi wajib diisi. <a href='edit.php?id=$id'>Kembali</a>");
    }
    if ($portofolio !== '' && !filter_var($portofolio, FILTER_VALIDATE_URL)) {
        die("URL portofolio tidak valid. <a href='edit.php?id=$id'>Kembali</a>");
    }

    $stmt = mysqli_prepare($conn, "UPDATE pembicara SET nama=?, keahlian=?, institusi=?, portofolio=? WHERE id_pembicara=?");
    mysqli_stmt_bind_param($stmt, "ssssi", $nama, $keahlian, $institusi, $portofolio, $id);
    mysqli_stmt_execute($stmt);

    header("Location: index.php?pesan=" . urlencode("Data berhasil diperbarui."));
    exit;
}

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
    <title>Edit Data Narasumber</title>
    <link rel="stylesheet" href="CSS%20Hal%201.css">
</head>
<body>
<div class="container">
    <div class="card">
        <h2>Edit Data Narasumber</h2>
        <form action="edit.php" method="POST">
            <input type="hidden" name="id" value="<?= $data['id_pembicara'] ?>">
            <div class="form-group">
                <label>Nama Lengkap Narasumber:</label>
                <input type="text" name="nama" value="<?= e($data['nama']) ?>" required>
            </div>
            <div class="form-group">
                <label>Profil Keahlian:</label>
                <input type="text" name="keahlian" value="<?= e($data['keahlian']) ?>" required>
            </div>
            <div class="form-group">
                <label>Riwayat Institusi:</label>
                <input type="text" name="institusi" value="<?= e($data['institusi']) ?>" required>
            </div>
            <div class="form-group">
                <label>Tautan Portofolio (URL):</label>
                <input type="url" name="portofolio" value="<?= e($data['portofolio']) ?>">
            </div>
            <button type="submit">Simpan Perubahan</button>
            <a href="index.php"><button type="button" style="background:#64748b;">Batal</button></a>
        </form>
    </div>
</div>
</body>
</html>