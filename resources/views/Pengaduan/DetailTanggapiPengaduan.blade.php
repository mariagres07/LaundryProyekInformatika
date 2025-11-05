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

        /* Navbar */
        .navbar {
            background-color: #7BBDE8;
        }

        .navbar-brand {
            color: white !important;
            font-weight: bold;
        }

        .navbar-toggler {
            border: none;
        }

        .navbar-toggler:focus {
            box-shadow: none;
        }

        /* Sidebar */
        .offcanvas {
            background-color: #7ba6e0;
            color: white;
            width: 230px !important;
        }

        .offcanvas a {
            display: flex;
            align-items: center;
            gap: 10px;
            color: white;
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            margin-bottom: 10px;
            transition: background-color 0.3s;
        }

        .offcanvas a:hover {
            background-color: #5a8cd6;
        }

        .logout-btn {
            background-color: #f8d7da;
            color: red;
            font-weight: bold;
            border: none;
            border-radius: 10px;
            padding: 8px;
            width: 100%;
        }

        .logout-btn:hover {
            background-color: #f1b0b7;
        }

        /* Konten Utama */
        .content {
            padding: 100px 30px;
            display: flex;
            justify-content: center;
            align-items: center;
        }

        /* Card Detail */
        .detail-container {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 85%;
            max-width: 1100px;
        }

        .detail-container h3 {
            text-align: center;
            color: #2d4b74;
            font-weight: bold;
            margin-bottom: 25px;
        }

        .badge {
            font-size: 14px;
            padding: 6px 10px;
            border-radius: 8px;
        }

        .alert {
            border-radius: 10px;
        }

        textarea {
            border-radius: 8px;
        }
    </style>
</head>

<body>
    @include('Dashboard.karyawan_sidenav')

    <!-- Konten -->
    <div class="content">
        <div class="detail-container">
            <h3>Detail Pengaduan</h3>

            <div class="mb-3">
                <h5 class="fw-bold text-primary">{{ $pengaduan->judulPengaduan }}</h5>
                <p class="text-muted mb-1">
                    Dari: <strong>{{ $pengaduan->pelanggan->namaPelanggan ?? 'Anonim' }}</strong> |
                    Tanggal: {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y') }}
                </p>
                <span
                    class="badge @if($pengaduan->statusPengaduan == 'Selesai') bg-success @elseif($pengaduan->statusPengaduan == 'Ditanggapi') bg-warning text-dark @else bg-secondary @endif">
                    {{ $pengaduan->statusPengaduan }}
                </span>
            </div>

            <div class="mb-4 p-3 bg-light rounded">
                <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
            </div>

            @if(!$pengaduan->tanggapanPengaduan)
            <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="pesan" class="form-label fw-bold">Tanggapan:</label>
                    <textarea name="pesan" id="pesan" class="form-control" rows="4" required></textarea>
                </div>
                <div class="d-flex justify-content-end gap-2">
                    <button type="submit" class="btn btn-primary px-4">
                        <i class="bi bi-send"></i> Kirim
                    </button>
                    <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary px-4">
                        <i class="bi bi-arrow-left"></i> Kembali
                    </a>
                </div>
            </form>
            @else
            <div class="alert alert-info mt-4">
                <i class="bi bi-chat-left-quote me-2"></i>
                <strong>Tanggapan:</strong> {{ $pengaduan->tanggapanPengaduan }}
            </div>
            <div class="text-end mt-3">
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary px-4">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
            @endif
        </div>
    </div>

    <!-- tombol kembali -->
    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>