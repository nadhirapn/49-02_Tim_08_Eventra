<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tiket</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
</head>
<body>
    <div class="kotak">
        <h2><?php echo e(isset($tiket) ? 'Edit Tiket' : 'Tambah Tiket Baru'); ?></h2>
        <form action="<?php echo e(isset($tiket) ? route('tiket.update', $tiket->id_tiket) : route('tiket.store')); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <?php if(isset($tiket)): ?>
                <?php echo method_field('PUT'); ?>
            <?php endif; ?>
            
            <label>Tipe Tiket:</label><br>
            <input type="text" name="tipe_tiket" value="<?php echo e(isset($tiket) ? $tiket->tipe_tiket : ''); ?>" required><br><br>
            
            <label>Harga:</label><br>
            <input type="number" name="harga" value="<?php echo e(isset($tiket) ? $tiket->harga : ''); ?>" required><br><br>
            
            <label>Kuota:</label><br>
            <input type="number" name="kuota" value="<?php echo e(isset($tiket) ? $tiket->kuota : ''); ?>" required><br><br>
            
            <label>Benefit:</label><br>
            <textarea name="benefit" required><?php echo e(isset($tiket) ? $tiket->benefit : ''); ?></textarea><br><br>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <br>
        <a href="<?php echo e(route('tiket.index')); ?>">Batal</a>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\Tubes_WAD\resources\views/form_tiket.blade.php ENDPATH**/ ?>