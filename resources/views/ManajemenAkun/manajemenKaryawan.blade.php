<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h4 class="mb-0">Data Karyawan</h4>
            <a href="{{ url('/mkaryawan/create') }}" class="btn btn-success btn-sm">+ Tambah Karyawan</a>
        </div>
        <div class="card-body">

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <table class="table table-bordered table-striped text-center">
                <thead class="table-primary">
                    <tr>
                        <th>Nama Lengkap</th>
                        <th>Username</th>
                        <th>No HP</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($karyawan as $row)
                    <tr>
                        <td>{{ $row->namaKaryawan }}</td>
                        <td>{{ $row->username }}</td>
                        <td>{{ $row->noHp }}</td>
                        <td>
                            <a href="{{ url('/mkaryawan/edit/'.$row->idKaryawan) }}" class="btn btn-warning btn-sm">Edit</a>
                            <a href="{{ url('/mkaryawan/hapus/'.$row->idKaryawan) }}" class="btn btn-danger btn-sm">Hapus</a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="4">Tidak ada data</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>

</body>
</html>
