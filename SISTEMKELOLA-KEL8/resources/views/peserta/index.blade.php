<!DOCTYPE html>
<html>
<head>
<title>Data Peserta</title>
<link rel="stylesheet" href="{{ asset('css/design-crud-peserta.css') }}">
</head>
<body>

<body>
<div class="container">

    <div class="header">
        <h1>Data Peserta Event</h1>
    </div>

    @if (session('success'))
        <div class="alert">{{ session('success') }}</div>
    @endif

    <a href="{{ route('peserta.create') }}" class="btn-tambah">+ Tambah Data</a>

    <div class="table-wrap">
        <table>
            <tr>
                <th>No</th>
                <th>Nama</th>
                <th>NIM</th>
                <th>Instansi / Kampus</th>
                <th>No. Kontak</th>
                <th>Email</th>
                <th>Aksi</th>
            </tr>
            @forelse ($data as $row)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $row->nama }}</td>
                <td>{{ $row->nim }}</td>
                <td>{{ $row->instansi }}</td>
                <td>{{ $row->no_kontak }}</td>
                <td>{{ $row->email }}</td>
                <td>
                    <a href="{{ route('peserta.edit', $row->id) }}" class="btn-edit">Edit</a>
                    <form action="{{ route('peserta.destroy', $row->id) }}" method="post" class="inline"
                          onsubmit="return confirm('Yakin hapus data ini?')">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn-hapus">Hapus</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr><td colspan="7">Belum ada data peserta.</td></tr>
            @endforelse
        </table>
    </div>

</div>
</body>
</body>
</html>