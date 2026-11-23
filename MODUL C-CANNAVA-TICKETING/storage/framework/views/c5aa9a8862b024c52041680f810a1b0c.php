<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket - Workshop</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
</head>
<body>
    <div class="kotak kotak-lebar">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #dee2e6;">
            <h3 style="margin: 0;">Halo, <?php echo e(auth()->user()->name); ?> <span style="font-weight: 400; font-size: 14px; color: #6c757d;">(<?php echo e(auth()->user()->role); ?>)</span></h3>
            <form action="<?php echo e(route('logout')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <button type="submit" class="btn btn-danger">Keluar</button>
            </form>
        </div>

        <h2 style="margin-bottom: 20px;">Daftar Tiket Tersedia</h2>
        
        <?php if(session('success')): ?>
            <div class="alert alert-success"><?php echo e(session('success')); ?></div>
        <?php endif; ?>
        <?php if(session('error')): ?>
            <div class="alert alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <?php if(auth()->user()->role === 'admin'): ?>
            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                <a href="<?php echo e(route('tiket.create')); ?>" class="btn btn-outline-dark">+ Tambah Tiket</a>
                <a href="<?php echo e(route('admin.laporan')); ?>" class="btn btn-outline-dark">Data Penjualan</a>
            </div>
        <?php endif; ?>

        <?php if(auth()->user()->role === 'user'): ?>
            <div style="margin-bottom: 20px;">
                <a href="<?php echo e(route('tiket.saya')); ?>" class="btn btn-outline-dark">Lihat Tiket Saya</a>
            </div>
        <?php endif; ?>

        <table>
            <thead>
                <tr>
                    <th>Tipe Tiket</th>
                    <th>Harga</th>
                    <th>Sisa Kuota</th>
                    <th>Benefit</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php $__currentLoopData = $tikets; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $row): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                <tr>
                    <td><strong><?php echo e($row->tipe_tiket); ?></strong></td>
                    <td>Rp <?php echo e(number_format($row->harga, 0, ',', '.')); ?></td>
                    <td><?php echo e($row->kuota); ?></td>
                    <td><?php echo e($row->benefit); ?></td>
                    <td>
                        <?php if(auth()->user()->role === 'admin'): ?>
                            <div class="aksi-flex">
                                <a href="<?php echo e(route('tiket.edit', $row->id_tiket)); ?>" class="btn btn-secondary">Edit</a>
                                <form action="<?php echo e(route('tiket.destroy', $row->id_tiket)); ?>" method="POST" style="display:inline;">
                                    <?php echo csrf_field(); ?>
                                    <?php echo method_field('DELETE'); ?>
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus tiket ini?')">Hapus</button>
                                </form>
                            </div>
                        <?php else: ?>
                            <?php if($row->kuota > 0): ?>
                                <a href="<?php echo e(route('tiket.form_beli', $row->id_tiket)); ?>" class="btn btn-primary">Beli Tiket</a>
                            <?php else: ?>
                                <span style="color: #adb5bd; font-size: 14px;">Habis Terjual</span>
                            <?php endif; ?>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
            </tbody>
        </table>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\KELOMPOK8-WAD\MODUL C-CANNAVA-TICKETING\resources\views/daftar_tiket.blade.php ENDPATH**/ ?>