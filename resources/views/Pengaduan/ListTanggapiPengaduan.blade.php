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
            transition: 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }
    </style>
</head>

<body>
    @include('Dashboard.karyawan_sidenav')

    <!-- Content -->
    <div class="container mt-4">
        <h4 class="mb-4"><i class="bi bi-reply-all-fill text-primary"></i> List Tanggapi Pengaduan</h4>

        <!-- Card 1 -->
        <div class="card p-3">
            <div class="card-body">
                <h5 class="card-title text-primary">Pakaian Hilang</h5>
                <p class="text-muted mb-1">Tanggal: 27/10/2025</p>
                <p>Pelanggan: <strong>Maria Petra</strong></p>
                <p>Deskripsi: Pakaian saya hilang setelah dicuci.</p>

                <span class="badge bg-warning text-dark mb-2">Status: Belum Ditanggapi</span>

            </div>
        </div>

        <!-- Card 2 -->
        <div class="card p-3">
            <div class="card-body">
                <h5 class="card-title text-primary">Baju Tidak Wangi</h5>
                <p class="text-muted mb-1">Tanggal: 25/10/2025</p>
                <p>Pelanggan: <strong>Andi Wijaya</strong></p>
                <p>Deskripsi: Baju tidak wangi seperti biasanya.</p>

                <span class="badge bg-success mb-2">Status: Sudah Ditanggapi</span>

                <button type="button" class="btn btn-kembali"><i class="bi bi-arrow-left"></i> Kembali</button>
            </div>
        </div>
    </div>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>