<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Pembicara</title>
    <link rel="stylesheet" href="{{ asset('css/speaker.css') }}">
</head>
<body>
<div class="container">

    <div class="card">
        <h1>Edit Data Pembicara</h1>
        <p class="subtitle">Ubah data narasumber lalu simpan perubahan.</p>
    </div>

    @if ($errors->any())
        <div class="alert alert-error" role="alert">
            <strong>Terdapat kesalahan pada isian Anda:</strong>
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card">
        <form method="POST" action="{{ route('speakers.update', $speaker) }}" novalidate>
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nama">Nama Lengkap Narasumber</label>
                <input type="text" id="nama" name="nama"
                       value="{{ old('nama', $speaker->nama) }}"
                       class="@error('nama') is-invalid @enderror"
                       maxlength="255" required autofocus>
                @error('nama') <small class="error-text">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="keahlian">Profil Keahlian</label>
                <input type="text" id="keahlian" name="keahlian"
                       value="{{ old('keahlian', $speaker->keahlian) }}"
                       class="@error('keahlian') is-invalid @enderror"
                       maxlength="255" required>
                @error('keahlian') <small class="error-text">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="institusi">Riwayat Institusi</label>
                <input type="text" id="institusi" name="institusi"
                       value="{{ old('institusi', $speaker->institusi) }}"
                       class="@error('institusi') is-invalid @enderror"
                       maxlength="255" required>
                @error('institusi') <small class="error-text">{{ $message }}</small> @enderror
            </div>

            <div class="form-group">
                <label for="portofolio">Tautan Portofolio (URL)</label>
                <input type="url" id="portofolio" name="portofolio"
                       value="{{ old('portofolio', $speaker->portofolio) }}"
                       class="@error('portofolio') is-invalid @enderror"
                       placeholder="https://contoh.com">
                @error('portofolio') <small class="error-text">{{ $message }}</small> @enderror
            </div>

            <div class="form-actions">
                <button type="submit">Simpan Perubahan</button>
                <a href="{{ route('speakers.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </form>
    </div>

</div>
</body>
</html>
