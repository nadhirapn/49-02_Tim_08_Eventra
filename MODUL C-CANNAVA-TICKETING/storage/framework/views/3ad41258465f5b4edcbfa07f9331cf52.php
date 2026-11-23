<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembelian</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
</head>
<body>
    <div class="kotak">
        <h2>Konfirmasi Pembelian</h2>
        
        <?php if(session('error')): ?>
            <div class="alert alert-error"><?php echo e(session('error')); ?></div>
        <?php endif; ?>

        <div style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
            <p><strong>Tipe Tiket:</strong> <?php echo e($tiket->tipe_tiket); ?></p>
            <p><strong>Benefit:</strong> <?php echo e($tiket->benefit); ?></p>
            <p><strong>Harga Satuan:</strong> Rp <span id="harga-satuan"><?php echo e($tiket->harga); ?></span></p>
            <p><strong>Sisa Kuota:</strong> <?php echo e($tiket->kuota); ?> tiket</p>
        </div>

        <form action="<?php echo e(route('tiket.beli', $tiket->id_tiket)); ?>" method="POST">
            <?php echo csrf_field(); ?>
            <label>Jumlah Tiket yang Dibeli:</label>
            <input type="number" id="jumlah_beli" name="jumlah_beli" value="1" min="1" max="<?php echo e($tiket->kuota); ?>" required oninput="hitungTotal()">
            
            <h3 style="margin-top: 10px;">Total Bayar: Rp <span id="total-harga"><?php echo e(number_format($tiket->harga, 0, ',', '.')); ?></span></h3>
            
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <a href="<?php echo e(route('tiket.index')); ?>" class="btn" style="background: #6b7280; flex: 1;">Batal</a>
                <button type="submit" class="btn btn-success" style="flex: 2;">Konfirmasi Bayar</button>
            </div>
        </form>
    </div>

    <!-- Script simpel untuk hitung otomatis harga x jumlah -->
    <script>
        function hitungTotal() {
            let harga = parseInt(document.getElementById('harga-satuan').innerText);
            let jumlah = parseInt(document.getElementById('jumlah_beli').value);
            
            if(isNaN(jumlah) || jumlah < 1) jumlah = 0;
            
            let total = harga * jumlah;
            document.getElementById('total-harga').innerText = new Intl.NumberFormat('id-ID').format(total);
        }
    </script>
</body>
</html><?php /**PATH C:\xampp\htdocs\Tubes_WAD\resources\views/beli_tiket.blade.php ENDPATH**/ ?>