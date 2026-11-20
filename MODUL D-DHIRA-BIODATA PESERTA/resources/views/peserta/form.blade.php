<!DOCTYPE html>
<html>
<head>
<title>{{ $peserta ? 'Edit' : 'Isi' }} Data Peserta</title>
<link rel="stylesheet" href="{{ asset('css/design2.css') }}">
<style>.error { color: #e0434f; font-size: 13px; margin: -10px 0 12px; }</style>
</head>
<body>

<h1>{{ $peserta ? 'Edit Data Peserta' : 'Isi Data Diri Peserta' }}</h1>

<form action="{{ $peserta ? route('peserta.update', $peserta->id) : route('peserta.store') }}" method="post">
  @csrf
  @if ($peserta)
      @method('PUT')
  @endif

  <label for="nama">Nama lengkap</label>
  <input type="text" id="nama" name="nama" value="{{ old('nama', $peserta->nama ?? '') }}" required>
  @error('nama') <div class="error">{{ $message }}</div> @enderror

  <label for="nim">ID Mahasiswa/NIM</label>
  <input type="text" id="nim" name="nim" value="{{ old('nim', $peserta->nim ?? '') }}" required>
  @error('nim') <div class="error">{{ $message }}</div> @enderror

  <label for="instansi">Asal instansi / kampus</label>
  <input type="text" id="instansi" name="instansi" value="{{ old('instansi', $peserta->instansi ?? '') }}" required>
  @error('instansi') <div class="error">{{ $message }}</div> @enderror

  <label for="no_kontak">Nomor kontak</label>
  <input type="text" id="no_kontak" name="no_kontak" value="{{ old('no_kontak', $peserta->no_kontak ?? '') }}" required>
  @error('no_kontak') <div class="error">{{ $message }}</div> @enderror

  <label for="email">Email aktif</label>
  <input type="email" id="email" name="email" value="{{ old('email', $peserta->email ?? '') }}" required>
  @error('email') <div class="error">{{ $message }}</div> @enderror

  <button type="submit">{{ $peserta ? 'Update' : 'Simpan' }}</button>
  <a href="{{ route('peserta.index') }}">Batal</a>
</form>

</body>
</html>