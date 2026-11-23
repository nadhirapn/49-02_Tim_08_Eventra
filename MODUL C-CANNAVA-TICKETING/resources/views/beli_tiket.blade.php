<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Konfirmasi Pembelian</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="kotak">
        <h2>Konfirmasi Pembelian</h2>
        
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <div style="background: #f9fafb; padding: 15px; border-radius: 8px; margin-bottom: 20px; border: 1px solid #e5e7eb;">
            <p><strong>Tipe Tiket:</strong> {{ $tiket->tipe_tiket }}</p>
            <p><strong>Benefit:</strong> {{ $tiket->benefit }}</p>
            <p><strong>Harga Satuan:</strong> Rp <span id="harga-satuan">{{ $tiket->harga }}</span></p>
            <p><strong>Sisa Kuota:</strong> {{ $tiket->kuota }} tiket</p>
        </div>

        <form action="{{ route('tiket.beli', $tiket->id_tiket) }}" method="POST">
            @csrf
            <label>Jumlah Tiket yang Dibeli:</label>
            <input type="number" id="jumlah_beli" name="jumlah_beli" value="1" min="1" max="{{ $tiket->kuota }}" required oninput="hitungTotal()">
            
            <h3 style="margin-top: 10px;">Total Bayar: Rp <span id="total-harga">{{ number_format($tiket->harga, 0, ',', '.') }}</span></h3>
            
            <div style="display: flex; gap: 10px; margin-top: 20px;">
                <a href="{{ route('tiket.index') }}" class="btn" style="background: #6b7280; flex: 1;">Batal</a>
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
</html>