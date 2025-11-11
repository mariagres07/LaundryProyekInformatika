<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry</title>

    <!-- Bootstrap 5.3 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <!-- Font Logo -->
    <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Lora', serif;
            background: linear-gradient(135deg, #e0efff, #ffffff);
            background-attachment: fixed;
            min-height: 100vh;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: url('https://www.transparenttextures.com/patterns/clean-textile.png');
            opacity: 0.25;
            z-index: -1;
        }

        /* Navbar */
        .navbar {
            background-color: #9ec7e0ff !important;
            color: white;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        }

        .navbar-brand {
            font-weight: 600;
            color: white !important;
            font-size: 1.35rem;
            letter-spacing: 0.5px;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2);
        }

        .navbar .btn {
            background-color: rgba(255, 255, 255, 0.9);
            color: #1f4e8a;
            border: none;
            transition: all 0.3s ease;
        }

        .navbar .btn:hover {
            background-color: #e8f0fd;
            transform: scale(1.05);
        }

        /* Sidebar kaca buram */
        .offcanvas {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(90, 150, 230, 0.2);
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.05);
        }

        .offcanvas-header h5 {
            font-weight: 600;
            color: #80b7ffd5;
        }

        .offcanvas-body a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            color: #2d4b74;
            transition: all 0.3s ease;
            font-family: 'Lora', serif;
        }

        .offcanvas-body a:hover {
            background: linear-gradient(90deg, #90c2ffff, #79b8ff);
            color: #fff;
            transform: translateX(6px);
            box-shadow: 0 3px 8px rgba(90, 150, 230, 0.2);
        }

        /* Ikon Pengaduan warna hitam polos */
        .offcanvas-body a.pengaduan i {
            color: #000;
            font-size: 1.2rem;
        }

        .offcanvas-body a.pengaduan:hover i {
            color: #fff;
        }

        /* Tombol keluar */
        .logout-btn {
            background-color: #dce3e8;
            color: red;
            font-weight: bold;
            border-radius: 12px;
            padding: 10px;
            border: none;
            width: 100%;
            text-align: center;
            margin-top: 15px;
            transition: 0.3s;
            font-family: 'Lora', serif;
        }

        .logout-btn:hover {
            background-color: #f8d7da;
            color: #a00;
            box-shadow: 0 2px 6px rgba(255, 0, 0, 0.2);
        }
    </style>

</head>

<body>

    <!-- Navbar -->
    <nav class="navbar shadow-sm">
        <div class="container-fluid">
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebarKaryawan"
                aria-controls="sidebarKaryawan">
                <i class="bi bi-list"></i>
            </button>
            <span class="navbar-brand mb-0 h1">IVA Laundry</span>
        </div>
    </nav>

    <!-- Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebarKaryawan" aria-labelledby="sidebarKaryawanLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarKaryawanLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body d-flex flex-column">
            <a href="{{ url('/dashboardKaryawan') }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            <a href="{{ url('/manajemenPengguna') }}">
                <i class="bi bi-people"></i> Manajemen Pengguna
            </a>
            <a href="{{ url('/manajemenLaundry') }}">
                <i class="bi bi-basket2-fill"></i> Manajemen Laundry
            </a>
            <a href="{{ url('/lihatDataPesanan') }}">
                <i class="bi bi-list-check"></i> Lihat Data Pesanan
            </a>
            <!-- Pengaduan dengan ikon pesan warna hitam polos -->
            <a href="{{ url('/manajemenLaundry') }}" class="pengaduan">
                <i class="bi bi-chat-dots-fill"></i> Pengaduan
            </a>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="logout-btn">KELUAR</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>


</body>

</html>