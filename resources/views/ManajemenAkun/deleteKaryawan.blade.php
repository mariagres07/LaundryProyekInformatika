<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Hapus Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow text-center">
        <div class="card-header bg-danger text-white">
            <h4 class="mb-0">Hapus Karyawan</h4>
        </div>
        <div class="card-body">
            <p>Apakah Anda yakin ingin menghapus karyawan <strong>{{ $karyawan->namaKaryawan }}</strong>?</p>

            <form method="POST" action="{{ url('/mkaryawan/destroy/'.$karyawan->idKaryawan) }}">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Ya, Hapus</button>
                <a href="{{ url('/mkaryawan') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

</body>
</html>
