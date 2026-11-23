<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tiket Saya</title>
    <link rel="stylesheet" href="{{ asset('style.css') }}">
    <style>
        .aksi-flex {
            display: flex;
            gap: 8px;
            align-items: center;
        }
        .btn-lokasi {
            background-color: #111827;
            color: #ffffff;
            border: 1px solid #111827;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-lokasi:hover {
            background-color: #374151;
            border-color: #374151;
        }
        .btn-batal-tiket {
            background-color: #f3f4f6;
            color: #111827;
            border: 1px solid #e5e7eb;
            padding: 8px 14px;
            border-radius: 8px;
            font-size: 13px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.2s ease;
        }
        .btn-batal-tiket:hover {
            background-color: #fef2f2;
            color: #dc2626;
            border-color: #fca5a5;
        }
        .modal-overlay {
            display: none;
            position: fixed;
            inset: 0;
            background-color: rgba(17, 24, 39, 0.6);
            z-index: 1000;
            justify-content: center;
            align-items: center;
            padding: 20px;
        }
        .modal-overlay.active {
            display: flex;
        }
        .detail-box {
            background: #f9fafb;
            padding: 20px;
            border-radius: 8px;
            margin-bottom: 24px;
            border: 1px solid #e5e7eb;
        }
        .detail-box p {
            margin: 10px 0;
            font-size: 14px;
            color: #4b5563;
            display: flex;
            justify-content: space-between;
            gap: 16px;
        }
        .detail-box span {
            font-weight: 600;
            color: #111827;
            text-align: right;
        }
        .lokasi-note {
            font-size: 13px;
            color: #6b7280;
            line-height: 1.5;
            margin: 0 0 20px 0;
        }
    </style>
</head>
<body style="align-items: flex-start; padding-top: 40px;">
    <div class="kotak kotak-lebar">
        <h2 style="margin-bottom: 20px;">Tiket Saya - {{ auth()->user()->name }}</h2>
        
        <a href="{{ route('tiket.index') }}" class="btn btn-dark" style="margin-bottom: 20px;">Katalog Tiket</a>
        
        @if(session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif
        @if(session('error'))
            <div class="alert alert-error">{{ session('error') }}</div>
        @endif

        <table>
            <thead>
                <tr>
                    <th>Tipe Tiket</th>
                    <th>Benefit</th>
                    <th>Jumlah Beli</th>
                    <th>Total Harga</th>
                    <th>Tanggal Beli</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @forelse($transaksis as $t)
                <tr>
                    <td><strong>{{ $t->tiket->tipe_tiket }}</strong></td>
                    <td>{{ $t->tiket->benefit }}</td>
                    <td>{{ $t->jumlah_beli }}</td>
                    <td>Rp {{ number_format($t->total_harga, 0, ',', '.') }}</td>
                    <td style="font-size: 13px; color: #6b7280;">{{ $t->created_at->format('d M Y, H:i') }}</td>
                    <td>
                        <div class="aksi-flex">
                            <button type="button" class="btn-lokasi"
                                data-tipe="{{ $t->tiket->tipe_tiket }}"
                                data-jumlah="{{ $t->jumlah_beli }} Tiket"
                                onclick="bukaModalLokasi(this)">
                                Detail Lokasi
                            </button>

                            <button type="button" class="btn-batal-tiket"
                                data-url="{{ route('tiket.batal', $t->id) }}"
                                data-tipe="{{ $t->tiket->tipe_tiket }}"
                                data-jumlah="{{ $t->jumlah_beli }} Tiket"
                                data-total="Rp {{ number_format($t->total_harga, 0, ',', '.') }}"
                                onclick="bukaModalBatal(this)">
                                Batalkan Tiket
                            </button>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="6" style="text-align: center; padding: 40px 0; color: #6b7280;">Belum ada riwayat pembelian tiket.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

    <div id="modal-lokasi" class="modal-overlay" onclick="tutupLuarModal(event)">
        <div class="kotak" style="max-width: 440px; padding: 30px;">
            <h3 style="margin-top: 0; margin-bottom: 8px;">Detail Lokasi Workshop</h3>
            <p class="lokasi-note">
                Tech Innovation Workshop 2026 — Simpan informasi tempat dan jadwal pelaksanaan acara di bawah ini.
            </p>

            <div class="detail-box">
                <p>Kategori Tiket: <span id="lokasi-tipe"></span></p>
                <p>Jumlah Tiket: <span id="lokasi-jumlah"></span></p>
                <p>Tanggal: <span>20 - 21 November 2026</span></p>
                <p>Waktu: <span>09.00 WIB - Selesai</span></p>
                <p>Tempat: <span>Grand Ballroom, Gedung Fakultas</span></p>
                <p>Alamat: <span>Telkom University, Bandung</span></p>
            </div>

            <p class="lokasi-note" style="margin-bottom: 20px;">
                *Tunjukkan halaman Tiket Saya ini kepada petugas di meja registrasi ulang saat hari pelaksanaan.
            </p>

            <button type="button" class="btn btn-dark btn-block" onclick="tutupModalLokasi()">Tutup</button>
        </div>
    </div>

    <div id="modal-batal" class="modal-overlay" onclick="tutupLuarModal(event)">
        <div class="kotak" style="max-width: 420px; padding: 30px;">
            <h3 style="margin-top: 0; margin-bottom: 8px;">Konfirmasi Pembatalan</h3>
            <p style="font-size: 14px; color: #6b7280; margin-bottom: 20px;">
                Tindakan ini akan membatalkan tiket dan mengembalikan kuota ke katalog.
            </p>

            <div class="detail-box">
                <p>Tipe Tiket: <span id="modal-tipe"></span></p>
                <p>Jumlah: <span id="modal-jumlah"></span></p>
                <p>Total Dana: <span id="modal-total"></span></p>
            </div>

            <div style="display: flex; gap: 10px;">
                <button type="button" class="btn btn-outline" style="flex: 1;" onclick="tutupModalBatal()">Tutup</button>
                <form id="form-batal" method="POST" style="flex: 1; margin: 0;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-dark btn-block">Ya, Batalkan</button>
                </form>
            </div>
        </div>
    </div>

    <script>
        function bukaModalLokasi(btn) {
            document.getElementById('lokasi-tipe').innerText = btn.dataset.tipe;
            document.getElementById('lokasi-jumlah').innerText = btn.dataset.jumlah;
            document.getElementById('modal-lokasi').classList.add('active');
        }

        function tutupModalLokasi() {
            document.getElementById('modal-lokasi').classList.remove('active');
        }

        function bukaModalBatal(btn) {
            document.getElementById('form-batal').action = btn.dataset.url;
            document.getElementById('modal-tipe').innerText = btn.dataset.tipe;
            document.getElementById('modal-jumlah').innerText = btn.dataset.jumlah;
            document.getElementById('modal-total').innerText = btn.dataset.total;
            document.getElementById('modal-batal').classList.add('active');
        }

        function tutupModalBatal() {
            document.getElementById('modal-batal').classList.remove('active');
        }

        function tutupLuarModal(e) {
            if (e.target.id === 'modal-lokasi') tutupModalLokasi();
            if (e.target.id === 'modal-batal') tutupModalBatal();
        }

        document.addEventListener('keydown', function(e) {
            if (e.key === 'Escape') {
                tutupModalLokasi();
                tutupModalBatal();
            }
        });
    </script>
</body>
</html>