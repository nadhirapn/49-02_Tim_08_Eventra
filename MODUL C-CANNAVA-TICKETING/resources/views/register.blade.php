<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi - Tech Innovation Workshop</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body style="align-items: center;">
    <div class="auth-container">
        <!-- Sisi Informasi Event -->
        <div class="auth-info">
            <h1>Tech Innovation Workshop 2026</h1>
            <p>Daftarkan akun Anda sekarang untuk mendapatkan akses pembelian tiket Workshop Eksklusif.</p>
            <p>Pastikan Anda mendaftar menggunakan email yang aktif, karena e-tiket dan informasi detail mengenai jadwal acara akan dikirimkan melalui email tersebut.</p>
        </div>
        
        <!-- Sisi Form Register -->
        <div class="auth-form-area">
            <h2 style="margin-bottom: 25px;">Registrasi Peserta</h2>
            <form action="{{ route('register') }}" method="POST">
                @csrf
                <label>Nama Lengkap (Sesuai KTP)</label>
                <input type="text" name="name" required>
                
                <label>Email Aktif</label>
                <input type="email" name="email" required>
                
                <label>Buat Password</label>
                <input type="password" name="password" placeholder="Minimal 6 karakter" required>
                
                <button type="submit" class="btn btn-primary btn-block">Daftar Sekarang</button>
            </form>
            <a href="{{ route('login') }}" class="auth-link">Sudah memiliki akun? <b>Masuk di sini</b></a>
        </div>
    </div>
</body>
</html>