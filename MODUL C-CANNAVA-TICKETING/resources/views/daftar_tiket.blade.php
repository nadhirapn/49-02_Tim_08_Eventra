<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Tiket - Workshop</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
</head>
<body>
    <div class="kotak kotak-lebar">
        <div style="display: flex; justify-content: space-between; align-items: center; margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #dee2e6;">
            <h3 style="margin: 0;">Halo, {{ auth()->user()->name }} <span style="font-weight: 400; font-size: 14px; color: #6c757d;">({{ auth()->user()->role }})</span></h3>
            <form action="{{ route('logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Keluar</button>
            </form>
        </div>

        <h2 style="margin-bottom: 20px;">Daftar Tiket Tersedia</h2>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        @if(auth()->user()->role === 'admin')
            <div style="margin-bottom: 20px; display: flex; gap: 10px;">
                <a href="{{ route('tiket.create') }}" class="btn btn-outline-dark">+ Tambah Tiket</a>
                <a href="{{ route('admin.laporan') }}" class="btn btn-outline-dark">Data Penjualan</a>
            </div>
        @endif

        @if(auth()->user()->role === 'user')
            <div style="margin-bottom: 20px;">
                <a href="{{ route('tiket.saya') }}" class="btn btn-outline-dark">Lihat Tiket Saya</a>
            </div>
        @endif

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
                @foreach($tikets as $row)
                <tr>
                    <td><strong>{{ $row->tipe_tiket }}</strong></td>
                    <td>Rp {{ number_format($row->harga, 0, ',', '.') }}</td>
                    <td>{{ $row->kuota }}</td>
                    <td>{{ $row->benefit }}</td>
                    <td>
                        @if(auth()->user()->role === 'admin')
                            <div class="aksi-flex">
                                <a href="{{ route('tiket.edit', $row->id_tiket) }}" class="btn btn-secondary">Edit</a>
                                <form action="{{ route('tiket.destroy', $row->id_tiket) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger" onclick="return confirm('Hapus tiket ini?')">Hapus</button>
                                </form>
                            </div>
                        @else
                            @if($row->kuota > 0)
                                <a href="{{ route('tiket.form_beli', $row->id_tiket) }}" class="btn btn-primary">Beli Tiket</a>
                            @else
                                <span style="color: #adb5bd; font-size: 14px;">Habis Terjual</span>
                            @endif
                        @endif
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</body>
</html>