<?php
require_once "koneksi.php";

// ID pembicara dari URL, contoh: detail_pembicara.php?id=1 (default 1)
$id_pembicara = isset($_GET['id']) ? (int) $_GET['id'] : 1;

$status_valid = ['Mendatang', 'Selesai', 'Dibatalkan'];
$error = "";

// Format tanggal ke bahasa Indonesia
function tanggal_indo($tanggal) {
    $bulan = [1 => 'Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    $t = strtotime($tanggal);
    return date('j', $t) . ' ' . $bulan[(int) date('n', $t)] . ' ' . date('Y', $t);
}

// ---------- PROSES SIMPAN JADWAL BARU ----------
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama_event   = trim($_POST['nama_event'] ?? '');
    $tanggal_sesi = $_POST['tanggal_sesi'] ?? '';
    $materi       = trim($_POST['materi'] ?? '');
    $status       = $_POST['status'] ?? '';

    if ($nama_event === '' || $tanggal_sesi === '' || $materi === '' || !in_array($status, $status_valid, true)) {
        $error = "Semua kolom wajib diisi dengan benar.";
    } else {
        $stmt = $koneksi->prepare(
            "INSERT INTO sesi_pembicara (id_pembicara, nama_event, tanggal_sesi, materi, status) VALUES (?, ?, ?, ?, ?)"
        );
        $stmt->bind_param("issss", $id_pembicara, $nama_event, $tanggal_sesi, $materi, $status);
        $stmt->execute();
        $stmt->close();

        // Redirect agar data tidak tersimpan dobel saat halaman di-refresh
        header("Location: detail_pembicara.php?id=" . $id_pembicara . "&sukses=1");
        exit;
    }
}

// ---------- AMBIL DATA PEMBICARA ----------
$stmt = $koneksi->prepare("SELECT * FROM pembicara WHERE id_pembicara = ?");
$stmt->bind_param("i", $id_pembicara);
$stmt->execute();
$pembicara = $stmt->get_result()->fetch_assoc();
$stmt->close();

// ---------- AMBIL DATA SESI ----------
$daftar_sesi = [];
if ($pembicara) {
    $stmt = $koneksi->prepare(
        "SELECT * FROM sesi_pembicara WHERE id_pembicara = ? ORDER BY tanggal_sesi DESC"
    );
    $stmt->bind_param("i", $id_pembicara);
    $stmt->execute();
    $daftar_sesi = $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail &amp; Jadwal Sesi Pembicara</title>
</head>
<body>

    <!-- Tombol Kembali ke Halaman Pertama -->
    <p>
        <a href="Sistem%20Pengelolaan%20Event%20&amp;%20Workshop.html">
            <button type="button">&larr; Kembali ke Halaman Utama</button>
        </a>
    </p>

    <!-- Judul Modul Halaman Kedua -->
    <h1>Detail Profil &amp; Penjadwalan Sesi Pembicara</h1>
    <p>Halaman ini digunakan untuk melihat detail narasumber dan mengelola jadwal sesi acara atau workshop yang diampu.</p>

    <hr>

<?php if (!$pembicara): ?>
    <p><strong>Data pembicara tidak ditemukan.</strong></p>
</body>
</html>
<?php exit; endif; ?>

    <!-- Ringkasan Detail Pembicara -->
    <h2>Ringkasan Profil Narasumber</h2>
    <ul>
        <li><strong>Nama Narasumber:</strong> <?= htmlspecialchars($pembicara['nama']) ?></li>
        <li><strong>Profil Keahlian:</strong> <?= htmlspecialchars($pembicara['keahlian']) ?></li>
        <li><strong>Institusi:</strong> <?= htmlspecialchars($pembicara['institusi']) ?></li>
        <li><strong>Portofolio:</strong>
            <?php if (!empty($pembicara['portofolio'])): ?>
                <a href="<?= htmlspecialchars($pembicara['portofolio']) ?>" target="_blank">Lihat Portofolio Lengkap</a>
            <?php else: ?>
                -
            <?php endif; ?>
        </li>
    </ul>

    <hr>

    <!-- Form Tambah Jadwal Sesi Baru -->
    <h2>Tambah Jadwal Sesi Baru</h2>

    <?php if (isset($_GET['sukses'])): ?>
        <p style="color:green;"><strong>Jadwal sesi berhasil disimpan.</strong></p>
    <?php endif; ?>
    <?php if ($error !== ""): ?>
        <p style="color:red;"><strong><?= htmlspecialchars($error) ?></strong></p>
    <?php endif; ?>

    <form method="post" action="detail_pembicara.php?id=<?= $id_pembicara ?>">
        <p>
            <label>Nama Event / Workshop:</label><br>
            <input type="text" name="nama_event" placeholder="Contoh: Seminar Nasional AI 2026" required>
        </p>

        <p>
            <label>Tanggal Sesi:</label><br>
            <input type="date" name="tanggal_sesi" required>
        </p>

        <p>
            <label>Peran / Topik Materi:</label><br>
            <input type="text" name="materi" placeholder="Contoh: Keynote Speaker / Cloud Architecture" required>
        </p>

        <p>
            <label>Status Sesi:</label><br>
            <select name="status">
                <?php foreach ($status_valid as $s): ?>
                    <option value="<?= $s ?>"><?= $s ?></option>
                <?php endforeach; ?>
            </select>
        </p>

        <p>
            <button type="submit">Simpan Jadwal Sesi</button>
        </p>
    </form>

    <hr>

    <!-- Tabel Riwayat & Jadwal Sesi -->
    <h2>Riwayat &amp; Jadwal Sesi Pembicara</h2>
    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Event / Workshop</th>
                <th>Tanggal Sesi</th>
                <th>Peran / Topik Materi</th>
                <th>Status</th>
            </tr>
        </thead>
        <tbody>
        <?php if (count($daftar_sesi) === 0): ?>
            <tr><td colspan="5" align="center">Belum ada jadwal sesi.</td></tr>
        <?php else: ?>
            <?php foreach ($daftar_sesi as $i => $sesi): ?>
            <tr>
                <td><?= $i + 1 ?></td>
                <td><?= htmlspecialchars($sesi['nama_event']) ?></td>
                <td><?= tanggal_indo($sesi['tanggal_sesi']) ?></td>
                <td><?= htmlspecialchars($sesi['materi']) ?></td>
                <td><?= htmlspecialchars($sesi['status']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
        </tbody>
    </table>

</body>
</html>