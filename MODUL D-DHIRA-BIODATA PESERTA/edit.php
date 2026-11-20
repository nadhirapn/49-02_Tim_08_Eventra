<?php
include 'koneksi.php';

$id = (int) $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM peserta WHERE id=$id");
$row = mysqli_fetch_assoc($result);

if (!$row) {
    die("Data tidak ditemukan");
}
?>
<!DOCTYPE html>
<html>
<head>
<title>Edit Data Peserta</title>
<link rel="stylesheet" href="design2.css">
</head>
<body>

<h1>Edit Data Peserta</h1>

<form action="proses-edit.php" method="post">
  <input type="hidden" name="id" value="<?= $row['id'] ?>">

  <label for="nama">Nama lengkap</label>
  <input type="text" id="nama" name="nama" value="<?= htmlspecialchars($row['nama']) ?>" required>

  <label for="nim">ID Mahasiswa/NIM</label>
  <input type="text" id="nim" name="nim" value="<?= htmlspecialchars($row['nim']) ?>" required>

  <label for="instansi">Asal instansi / kampus</label>
  <input type="text" id="instansi" name="instansi" value="<?= htmlspecialchars($row['instansi']) ?>" required>

  <label for="no_kontak">Nomor kontak</label>
  <input type="text" id="no_kontak" name="no_kontak" value="<?= htmlspecialchars($row['no_kontak']) ?>" required>

  <label for="email">Email aktif</label>
  <input type="email" id="email" name="email" value="<?= htmlspecialchars($row['email']) ?>" required>

  <button type="submit">Update</button>
</form>

</body>
</html>
