<?php
include "koneksi.php";
$result = mysqli_query($conn, "SELECT * FROM pembicara ORDER BY id_pembicara DESC");
$pesan  = $_GET['pesan'] ?? '';
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistem Pengelolaan Event &amp; Workshop</title>
    <link rel="stylesheet" href="CSS%20Hal%201.css">
</head>
<body>
<div class="container">

    <div class="card">
        <h1>Pengelolaan Data Pembicara / Speaker</h1>
        <p class="subtitle">Halaman ini digunakan untuk mengelola data narasumber, profil keahlian, riwayat institusi, dan tautan portofolio.</p>
    </div>

    <?php if ($pesan): ?>
        <div class="card" style="background:#dcfce7;color:#166534;"><?= e($pesan) ?></div>
    <?php endif; ?>

    <div class="card">
        <h2>Tambah Data Narasumber</h2>
        <form action="simpan.php" method="POST">
            <div class="form-group">
                <label for="nama">Nama Lengkap Narasumber:</label>
                <input type="text" id="nama" name="nama" placeholder="Firsya Ridwan Musa" required>
            </div>
            <div class="form-group">
                <label for="keahlian">Profil Keahlian:</label>
                <input type="text" id="keahlian" name="keahlian" placeholder="Contoh: Teknologi / Bisnis" required>
            </div>
            <div class="form-group">
                <label for="institusi">Riwayat Institusi:</label>
                <input type="text" id="institusi" name="institusi" placeholder="Telkom University" required>
            </div>
            <div class="form-group">
                <label for="portofolio">Tautan Portofolio (URL):</label>
                <input type="url" id="portofolio" name="portofolio" placeholder="https://example.com/portofolio">
            </div>
            <button type="submit">Simpan Data Pembicara</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Pembicara / Speaker</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width:50px;">No</th>
                        <th>Nama Narasumber</th>
                        <th>Profil Keahlian</th>
                        <th>Riwayat Institusi</th>
                        <th>Tautan Portofolio</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                <?php $no = 1; while ($row = mysqli_fetch_assoc($result)): ?>
                    <tr>
                        <td><?= $no++ ?></td>
                        <td><strong><?= e($row['nama']) ?></strong></td>
                        <td><span class="badge"><?= e($row['keahlian']) ?></span></td>
                        <td><?= e($row['institusi']) ?></td>
                        <td>
                            <?php if ($row['portofolio']): ?>
                                <a href="<?= e($row['portofolio']) ?>" target="_blank" class="btn-link">Lihat Portofolio &rarr;</a>
                            <?php else: ?>-<?php endif; ?>
                        </td>
                        <td>
                            <a href="detail.php?id=<?= $row['id_pembicara'] ?>" class="btn-link">Detail</a> |
                            <a href="edit.php?id=<?= $row['id_pembicara'] ?>" class="btn-link">Edit</a> |
                            <form action="hapus.php" method="POST" style="display:inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                <input type="hidden" name="id" value="<?= $row['id_pembicara'] ?>">
                                <button type="submit" style="padding:4px 10px;background:#dc2626;">Hapus</button>
                            </form>
                        </td>
                    </tr>
                <?php endwhile; ?>
                <?php if ($no === 1): ?>
                    <tr><td colspan="6" style="text-align:center;">Belum ada data pembicara.</td></tr>
                <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>