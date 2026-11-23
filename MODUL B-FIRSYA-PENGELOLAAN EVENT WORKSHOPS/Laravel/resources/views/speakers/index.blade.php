<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modul Pembicara / Speaker</title>
    <link rel="stylesheet" href="{{ asset('css/speaker.css') }}">
</head>
<body>
<div class="container">

    <div class="card">
        <h1>Pengelolaan Data Pembicara / Speaker</h1>
        <p class="subtitle">Halaman ini digunakan untuk mengelola data narasumber, profil keahlian, riwayat institusi, dan tautan portofolio.</p>
    </div>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    @if($errors->any())
        <div class="alert alert-error">
            @foreach($errors->all() as $e) <div>{{ $e }}</div> @endforeach
        </div>
    @endif

    <div class="card">
        <h2>Tambah Data Narasumber</h2>
        <form method="POST" action="{{ route('speakers.store') }}">
            @csrf
            <div class="form-group">
                <label for="nama">Nama Lengkap Narasumber:</label>
                <input type="text" id="nama" name="nama" value="{{ old('nama') }}" placeholder="Firsya Ridwan Musa">
            </div>
            <div class="form-group">
                <label for="keahlian">Profil Keahlian:</label>
                <input type="text" id="keahlian" name="keahlian" value="{{ old('keahlian') }}" placeholder="Contoh: Teknologi / Bisnis">
            </div>
            <div class="form-group">
                <label for="institusi">Riwayat Institusi:</label>
                <input type="text" id="institusi" name="institusi" value="{{ old('institusi') }}" placeholder="Telkom University">
            </div>
            <div class="form-group">
                <label for="portofolio">Tautan Portofolio (URL):</label>
                <input type="url" id="portofolio" name="portofolio" value="{{ old('portofolio') }}" placeholder="https://example.com/portofolio">
            </div>
            <button type="submit">Simpan Data Pembicara</button>
        </form>
    </div>

    <div class="card">
        <h2>Daftar Pembicara / Speaker</h2>
        <div class="table-responsive">
            <table>
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Nama Narasumber</th>
                        <th>Profil Keahlian</th>
                        <th>Riwayat Institusi</th>
                        <th>Tautan Portofolio</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($speakers as $s)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td><strong>{{ $s->nama }}</strong></td>
                        <td><span class="badge">{{ $s->keahlian }}</span></td>
                        <td>{{ $s->institusi }}</td>
                        <td>
                            @if($s->portofolio)
                                <a href="{{ $s->portofolio }}" target="_blank" class="btn-link">Lihat Portofolio &rarr;</a>
                            @else
                                -
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('speakers.edit', $s) }}" class="btn btn-warning">Edit</a>
                            <form action="{{ route('speakers.destroy', $s) }}" method="POST" style="display:inline"
                                onsubmit="return confirm('Yakin hapus data ini?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn-danger">Hapus</button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr><td colspan="6" style="text-align:center">Belum ada data pembicara</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
</body>
</html>