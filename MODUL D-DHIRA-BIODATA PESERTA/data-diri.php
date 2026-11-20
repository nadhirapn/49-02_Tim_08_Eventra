<!DOCTYPE html>
<html>
<head>
<title>Isi Data Diri Peserta</title>

<link rel="stylesheet" href="design2.css">

</head>
<body>

<h1>Isi Data Diri Peserta</h1>

<form action="proses-tambah.php" method="post">

  <label for="nama">Nama lengkap</label>
  <input type="text" id="nama" name="nama" required>

  <label for="nim">ID Mahasiswa/NIM</label>
  <input type="text" id="nim" name="nim" required>

  <label for="instansi">Asal instansi / kampus</label>
  <input type="text" id="instansi" name="instansi" required>

  <label for="no_kontak">Nomor kontak</label>
  <input type="text" id="no_kontak" name="no_kontak" required>

  <label for="email">Email aktif</label>
  <input type="email" id="email" name="email" required>

  <button type="submit">Simpan</button>

</form>

</body>
</html>