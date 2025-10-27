<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">

    <style>
    body {
        background-color: #f8f9fa;
    }

    /* Navbar */
    .navbar-custom {
        background-color: #ffffff;
        box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
    }

    /* Sidebar */
    .offcanvas-body a {
        display: block;
        padding: 10px 0;
        color: #212529;
        text-decoration: none;
        font-weight: 500;
    }

    .offcanvas-body a:hover {
        color: #0d6efd;
    }

    .logout-btn {
        width: 100%;
        background-color: #f8f9fa;
        color: red;
        border: none;
        padding: 10px;
        border-radius: 8px;
        font-weight: bold;
    }

    .logout-btn:hover {
        background-color: #f5c2c7;
    }

    /* Main content */
    .main-content {
        margin-top: 80px;
    }

    /* Card styling */
    .card-custom {
        width: 100%;
        border: none;
        border-radius: 15px;
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        padding: 25px;
        background-color: #fff;
    }

    h2.text-primary {
        font-size: 2.3rem;
        text-align: center;
        font-weight: 700;
        letter-spacing: 0.5px;
        margin-bottom: 30px;
    }

    .btn-primary {
        border-radius: 50px;
        padding: 8px 25px;
        font-weight: 500;
    }

    .btn-secondary {
        border-radius: 50px;
        padding: 8px 25px;
        font-weight: 500;
    }

    .btn-secondary i {
        margin-right: 5px;
    }
    </style>
</head>

@include('Dashboard.karyawan_sidenav')

<body>

    <div class="container-fluid py-4 px-5 main-content">
        <div class="card card-custom">
            <h2 class="text-primary">
                📋 Detail Pengaduan
            </h2>

            <div class="card-body">
                <div class="mb-4">
                    <h4 class="fw-bold">{{ $pengaduan->judulPengaduan }}</h4>
                    <p class="text-muted mb-1">
                        Dari: <strong>{{ $pengaduan->pelanggan->namaPelanggan ?? 'Anonim' }}</strong> |
                        Tanggal: {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y') }}
                    </p>
                    <span class="badge 
                        @if($pengaduan->statusPengaduan == 'Selesai') bg-success 
                        @elseif($pengaduan->statusPengaduan == 'Ditanggapi') bg-warning text-dark 
                        @else bg-secondary @endif">
                        {{ $pengaduan->statusPengaduan }}
                    </span>
                </div>

                <!-- Isi Pengaduan -->
                <div class="mb-4 p-3 bg-light rounded">
                    <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
                </div>

                <form action="{{ route('pengaduan.kirim', $pengaduan->idPengaduan) }}" method="POST">
                    @csrf
                    <div class="mb-3">
                        <label for="pesan" class="form-label fw-bold">Tanggapan:</label>
                        <textarea name="pesan" id="pesan" class="form-control" rows="4" required></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">
                        <i class="bi bi-send"></i> Kirim Tanggapan
                    </button>
                </form>


                <!-- Jika sudah ada tanggapan -->
                @if($pengaduan->tanggapanPengaduan)
                <div class="alert alert-info mt-4">
                    <i class="bi bi-chat-left-quote me-2"></i>
                    <strong>Tanggapan:</strong> {{ $pengaduan->tanggapanPengaduan }}
                </div>
                @endif

                <!-- Tombol kembali -->
                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>