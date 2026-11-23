<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Tiket</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="kotak">
        <h2>{{ isset($tiket) ? 'Edit Tiket' : 'Tambah Tiket Baru' }}</h2>
        <form action="{{ isset($tiket) ? route('tiket.update', $tiket->id_tiket) : route('tiket.store') }}" method="POST">
            @csrf
            @if(isset($tiket))
                @method('PUT')
            @endif
            
            <label>Tipe Tiket:</label><br>
            <input type="text" name="tipe_tiket" value="{{ isset($tiket) ? $tiket->tipe_tiket : '' }}" required><br><br>
            
            <label>Harga:</label><br>
            <input type="number" name="harga" value="{{ isset($tiket) ? $tiket->harga : '' }}" required><br><br>
            
            <label>Kuota:</label><br>
            <input type="number" name="kuota" value="{{ isset($tiket) ? $tiket->kuota : '' }}" required><br><br>
            
            <label>Benefit:</label><br>
            <textarea name="benefit" required>{{ isset($tiket) ? $tiket->benefit : '' }}</textarea><br><br>
            
            <button type="submit" class="btn btn-primary">Simpan</button>
        </form>
        <br>
        <a href="{{ route('tiket.index') }}">Batal</a>
    </div>
</body>
</html>