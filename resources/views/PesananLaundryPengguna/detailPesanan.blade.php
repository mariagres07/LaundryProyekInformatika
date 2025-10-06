<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container py-4">
    <a href="{{ route('pengaduan.index') }}" class="btn btn-outline-secondary btn-sm mb-3">← Kembali</a>
    <div class="card shadow-sm">
        <div class="card-body">
            <h5 class="text-primary">{{ $pengaduan->judulPengaduan }}</h5>
            <p>{{ $pengaduan->deskripsi }}</p>
            <hr>
            <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <textarea name="pesan" class="form-control" rows="3" placeholder="Tulis tanggapan..."></textarea>
                </div>
                <button class="btn btn-primary">Kirim Tanggapan</button>
            </form>
            @if($pengaduan->tanggapanPengaduan)
            <div class="alert alert-info mt-3">
                <strong>Tanggapan:</strong>
                <p>{{ $pengaduan->tanggapanPengaduan }}</p>
            </div>
            @endif
        </div>
    </div>
</div>
</body>
</html>
