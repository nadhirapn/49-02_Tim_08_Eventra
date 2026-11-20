<?php
include 'koneksi.php';
$data = mysqli_query($conn, "SELECT * FROM peserta ORDER BY id ASC");
?>
<!DOCTYPE html>
<html>
<head>
<title>Data Peserta</title>
<link rel="stylesheet" href="design-crud.css">
</head>
<body>

<h1>Data Peserta Event</h1>

<a href="data-diri.php">+ Tambah Data</a>
<br><br>

<table border="1" cellpadding="8" cellspacing="0">
    <tr>
        <th>No</th>
        <th>Nama</th>
        <th>NIM</th>
        <th>Instansi / Kampus</th>
        <th>No. Kontak</th>
        <th>Email</th>
        <th>Aksi</th>
    </tr>
    <?php
    $no = 1;
    while ($row = mysqli_fetch_assoc($data)) {
    ?>
    <tr>
        <td><?= $no++ ?></td>
        <td><?= htmlspecialchars($row['nama']) ?></td>
        <td><?= htmlspecialchars($row['nim']) ?></td>
        <td><?= htmlspecialchars($row['instansi']) ?></td>
        <td><?= htmlspecialchars($row['no_kontak']) ?></td>
        <td><?= htmlspecialchars($row['email']) ?></td>
<td>
    <a href="edit.php?id=<?= $row['id'] ?>">Edit</a> |
    <a href="hapus.php?id=<?= $row['id'] ?>" onclick="return confirm('Yakin hapus data ini?')">Hapus</a>
</td>
    </tr>
    <?php } ?>
</table>

</body>
</html>