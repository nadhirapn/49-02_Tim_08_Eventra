<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
</head>
<body>
    <div class="kotak kotak-lebar">
        <h2>Laporan Penjualan Tiket</h2>
        
        <a href="<?php echo e(route('tiket.index')); ?>" class="btn btn-primary" style="margin-bottom: 20px;">Kembali ke Katalog</a>

        <table>
            <thead>
                <tr>
                    <th>Nama Pembeli</th>
                    <th>Email Pembeli</th>
                    <th>Tipe Tiket</th>
                    <th>Jumlah Beli</th>
                    <th>Total Harga</th>
                    <th>Tanggal Transaksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__empty_1 = true; $__currentLoopData = $transaksis; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $t): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); $__empty_1 = false; ?>
                <tr>
                    <td><?php echo e($t->user->name); ?></td>
                    <td><?php echo e($t->user->email); ?></td>
                    <td><?php echo e($t->tiket->tipe_tiket); ?></td>
                    <td><?php echo e($t->jumlah_beli); ?></td>
                    <td>Rp <?php echo e(number_format($t->total_harga, 0, ',', '.')); ?></td>
                    <td><?php echo e($t->created_at->format('d M Y H:i')); ?></td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); if ($__empty_1): ?>
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada tiket yang terjual.</td>
                </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\KELOMPOK8-WAD\MODUL C-CANNAVA-TICKETING\resources\views/laporan_penjualan.blade.php ENDPATH**/ ?>