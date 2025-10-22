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

        /*Navbar*/
        .navbar-custom {
            background-color: #ffffff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
        }

        .menu-btn {
            background-color: #0d6efd;
            color: #fff;
            border: none;
            border-radius: 10px;
            padding: 8px 12px;
        }

        .menu-btn:hover {
            background-color: #0b5ed7;
        }

        /*Sidebar*/
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

        /*Main content*/
        .main-content {
            margin-top: 80px;
        }

        /*Card styling*/
        .card-custom {
            width: 100%;
            border: none;
            border-radius: 15px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
            padding: 25px;
            background-color: #fff;
        }

        /*Title*/
        h2.text-primary {
            font-size: 2.3rem;
            text-align: center;
            font-weight: 700;
            letter-spacing: 0.5px;
            margin-bottom: 30px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        /*Button styling*/
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
<!-- Include navbar & sidebar -->
@include('Dashboard.pelanggan_sidenav')

<body>

    <!--Konten Utama -->
    <div class="container-fluid py-4 px-5 main-content">
        <div class="card card-custom">
            <h2 class="text-primary">
                📋 Detail Pengaduan
            </h2>

            <div class="card-body">
                <div class="mb-4">
                    <h4 class="fw-bold">{{ $pengaduan->judulPengaduan }}</h4>
                    <p class="text-muted mb-1">
                        Dari: <strong>Anonim</strong> |
                        Tanggal: {{ \Carbon\Carbon::parse($pengaduan->tanggalPengaduan)->format('d/m/Y') }}
                    </p>
                    <span class="badge bg-success">Selesai</span>
                </div>

                <div class="mb-4 p-3 bg-light rounded">
                    <p class="mb-0">{{ $pengaduan->deskripsi }}</p>
                </div>

                <div class="alert alert-success d-flex align-items-center">
                    <i class="bi bi-check-circle me-2"></i>
                    Pengaduan ini telah selesai.
                </div>

                <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary mt-3">
                    <i class="bi bi-arrow-left"></i> Kembali
                </a>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>