<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan Penjualan</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="kotak kotak-lebar">
        <h2>Laporan Penjualan Tiket</h2>
        
        <a href="{{ route('tiket.index') }}" class="btn btn-primary" style="margin-bottom: 20px;">Kembali ke Katalog</a>

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
                @forelse($transaksis as $t)
                <tr>
                    <td>{{ $t->user->name }}</td>
                    <td>{{ $t->user->email }}</td>
                    <td>{{ $t->tiket->tipe_tiket }}</td>
                    <td>{{ $t->jumlah_beli }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td>{{ $t->created_at->format('d M Y H:i') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center;">Belum ada tiket yang terjual.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</body>
</html>