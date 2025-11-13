<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f9fc;
            min-height: 100vh;
        }

        .content {
            padding: 100px 30px;
            display: flex;
            justify-content: center;
        }

        .form-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 85%;
            max-width: 1100px;
        }

        .text-label {
            font-weight: 600;
            color: #2D4B74;
            margin-bottom: 5px;
        }

        .form-control {
            border-radius: 8px;
        }

        button {
            border-radius: 8px;
        }

        .btn-back {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background-color: #8ab2d3ff;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <div class="content">
        <div class="form-container">

            <h3>Detail Pengaduan</h3>

            <div class="mb-3">
                <label class="text-label">ID Pengaduan:</label>
                <input type="text" class="form-control" value="{{ $pengaduan->idPengaduan }}" readonly>
            </div>

            <div class="mb-3">
                <label class="text-label">Nama Pelanggan:</label>
                <input type="text" class="form-control" value="{{ $pengaduan->pelanggan->nama ?? 'Tidak diketahui' }}" readonly>
            </div>

            <div class="mb-3">
                <label class="text-label">Judul Pengaduan:</label>
                <input type="text" class="form-control" value="{{ $pengaduan->judulPengaduan }}" readonly>
            </div>

            <div class="mb-3">
                <label class="text-label">Isi Pengaduan:</label>
                <textarea class="form-control" rows="5" readonly>{{ $pengaduan->deskripsi }}</textarea>
            </div>

            <div class="mb-3">
                <label class="text-label">Tanggal Pengaduan:</label>
                <input type="text" class="form-control"
                    value="{{ $pengaduan->tanggalPengaduan ? \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d M Y') : '-' }}"
                    readonly>
            </div>

            @if($pengaduan->media)
            <div class="mb-3">
                <label class="text-label">Lampiran:</label><br>
                <a href="{{ asset('storage/pengaduan/' . $pengaduan->media) }}" target="_blank"
                    class="btn btn-info btn-sm">
                    <i class="bi bi-file-earmark"></i> Lihat Lampiran
                </a>
            </div>
            @endif

            <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label class="text-label">Tanggapan</label>
                    <textarea name="pesan" class="form-control" rows="4" required placeholder="Tuliskan tanggapan di sini...">{{ old('pesan', $pengaduan->tanggapanPengaduan) }}</textarea>
                </div>

                <div class="d-flex justify-content-between">
                    <button type="submit" class="btn btn-success"><i class="bi bi-send"></i> Kirim Tanggapan</button>
                </div>
            </form>

        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>