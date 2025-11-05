<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry - Pelanggan</title>

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

        /* Background overlay lembut */
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
            background: linear-gradient(90deg, #5fa1f2, #79b8ff);
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

        /* Sidebar dengan efek blur kaca */
        .offcanvas {
            background: rgba(255, 255, 255, 0.75);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(90, 150, 230, 0.2);
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.05);
        }

        .offcanvas-header h5 {
            font-weight: 600;
            color: #1f4e8a;
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
            background: linear-gradient(90deg, #5fa1f2, #79b8ff);
            color: #fff;
            transform: translateX(6px);
            box-shadow: 0 3px 8px rgba(90, 150, 230, 0.2);
        }

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
            <button class="btn" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
                <i class="bi bi-list"></i>
            </button>
            <span class="navbar-brand mb-0 h1">IVA Laundry - Pelanggan</span>
        </div>
    </nav>

    <!-- Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <a href="{{ url('/tampilanPelanggan') }}">
                <i class="bi bi-house"></i> Dashboard
            </a>
            <a href="{{ url('/pesanLaundry') }}">
                <i class="bi bi-basket2-fill"></i> Pesan Laundry
            </a>
            <a href="{{ url('/lihatData') }}">
                <i class="bi bi-file-earmark-text-fill"></i> Lihat Data Pesanan
            </a>
            <a href="{{ url('/editprofil') }}">
                <i class="bi bi-person-circle"></i> Edit Profil
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