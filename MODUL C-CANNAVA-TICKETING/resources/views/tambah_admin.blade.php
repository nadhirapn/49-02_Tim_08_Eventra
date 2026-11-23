<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Karyawan - Tiket</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="kotak">
        <h2>Tambah Akun Admin/Karyawan</h2>
        <form action="{{ route('admin.store') }}" method="POST">
            @csrf
            <label>Nama Karyawan:</label><br>
            <input type="text" name="name" required><br><br>
            
            <label>Email Karyawan:</label><br>
            <input type="email" name="email" required><br><br>
            
            <label>Password (Min. 6 karakter):</label><br>
            <input type="password" name="password" required><br><br>
            
            <button type="submit" class="btn btn-primary">Simpan Karyawan</button>
        </form>
        <br>
        <a href="{{ route('tiket.index') }}">Kembali</a>
    </div>
</body>
</html>