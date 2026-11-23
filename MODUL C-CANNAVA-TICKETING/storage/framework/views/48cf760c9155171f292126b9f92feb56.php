<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Tech Innovation Workshop</title>
    <link rel="stylesheet" href="<?php echo e(asset('style.css')); ?>">
</head>
<body style="align-items: center;">
    <div class="auth-container">
        <!-- Sisi Informasi Event -->
        <div class="auth-info">
            <h1>Tech Innovation Workshop 2026</h1>
            <p>Bergabunglah bersama para profesional industri dalam lokakarya eksklusif selama dua hari yang membahas tentang tren teknologi masa depan, kecerdasan buatan, dan pengembangan perangkat lunak modern.</p>
            <p><strong>Benefit Peserta:</strong></p>
            <ul style="color: #ced4da; font-size: 14px; line-height: 1.6; padding-left: 20px;">
                <li>Sertifikat resmi berstandar industri</li>
                <li>Materi eksklusif dari praktisi</li>
                <li>Sesi Q&A dan Networking</li>
                <li>Makan siang & Coffee Break</li>
            </ul>
        </div>
        
        <!-- Sisi Form Login -->
        <div class="auth-form-area">
            <h2 style="margin-bottom: 25px;">Akses Akun</h2>
            
            <?php if(session('error')): ?>
                <div class="alert alert-error"><?php echo e(session('error')); ?></div>
            <?php endif; ?>
            <?php if(session('success')): ?>
                <div class="alert alert-success"><?php echo e(session('success')); ?></div>
            <?php endif; ?>

            <form action="<?php echo e(route('login')); ?>" method="POST">
                <?php echo csrf_field(); ?>
                <label>Email Address</label>
                <input type="email" name="email" required>
                
                <label>Password</label>
                <input type="password" name="password" required>
                
                <button type="submit" class="btn btn-primary btn-block">Masuk</button>
            </form>
            <a href="<?php echo e(route('register')); ?>" class="auth-link">Belum memiliki akses tiket? <b>Daftar di sini</b></a>
        </div>
    </div>
</body>
</html><?php /**PATH C:\xampp\htdocs\Tubes_WAD\resources\views/login.blade.php ENDPATH**/ ?>