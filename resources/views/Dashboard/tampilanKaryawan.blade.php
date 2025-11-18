<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Karyawan - IVA Laundry</title>

    @if (session('role') !== 'karyawan')
    <script>
        window.location.href = "{{ route('login.show') }}";
    </script>
    @endif

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        * {
            font-family: "Poppins", sans-serif;
            box-sizing: border-box;
        }

        body {
            background-color: #eaf6ff;
            margin: 0;
            padding: 0;
        }

        /* HEADER */
        .header-wrapper {
            position: relative;
            width: 100%;
            height: 130px;
            overflow: hidden;
            border-bottom-left-radius: 40px;
            border-bottom-right-radius: 40px;
            margin-bottom: 40px;
        }

        .header-bg {
            background-image: url('water.jpg');
            background-size: cover;
            background-position: center;
            width: 100%;
            height: 100%;
            filter: brightness(0.75);
        }

        .header-content {
            position: absolute;
            top: 50%;
            left: 40px;
            transform: translateY(-50%);
            color: white;
            font-weight: 700;
            font-size: 34px;
        }

        /* Hilangkan garis biru (outline / focus) */
        a,
        a:focus,
        a:active,
        a:focus-visible,
        .menu-card:focus,
        .menu-card:active {
            outline: none !important;
            box-shadow: none !important;
            border: none !important;
        }

        /* Hapus warna biru default dari <a> */
        a {
            color: inherit !important;
            text-decoration: none !important;
        }

        /* Pastikan teks menu-card selalu hitam */
        .menu-card h5 {
            color: black !important;
        }

        /* Icon default */
        .menu-card i {
            color: #7ba6e0;
        }

        .hidden {
            display: none !important;
        }

        /* Kartu Menu */
        .menu-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: 0.2s;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            font-size: 50px;
            margin-bottom: 15px;
        }

        /* Tombol kembali */
        .btn-back {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background-color: #8ab2d3;
            color: white;
            border: none;
            border-radius: 50%;
            width: 50px;
            height: 50px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.4rem;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
            z-index: 2000;
        }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <!-- HEADER -->
    <div class="header-wrapper">
        <div class="header-bg"></div>
        <div class="header-content">
            Welcome! <span>{{ session('username') ?? 'Karyawan' }}</span>
        </div>
    </div>

    <button id="backBtn" class="btn-back hidden" onclick="showDashboard()">
        <i class="bi bi-arrow-left"></i>
    </button>

    <div class="container py-4">

        <!-- DASHBOARD -->
        <div id="dashboard" class="row justify-content-center">

            <div class="col-md-3 mb-4">
                <div class="menu-card" onclick="showPengguna()">
                    <i class="bi bi-people menu-icon"></i>
                    <h5>Manajemen Pengguna</h5>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <div class="menu-card" onclick="showLaundry()">
                    <i class="bi bi-basket menu-icon"></i>
                    <h5>Manajemen Laundry</h5>
                </div>
            </div>

            <div class="col-md-3 mb-4">
                <a href="{{ route('pengaduan.index') }}">
                    <div class="menu-card">
                        <i class="bi bi-chat-dots menu-icon"></i>
                        <h5>Pengaduan</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="{{ url('/lihatdata') }}">
                    <div class="menu-card">
                        <i class="bi bi-eye-fill menu-icon"></i>
                        <h5>Lihat Data Pesanan</h5>
                    </div>
                </a>
            </div>

        </div>

        <!-- MANAJEMEN PENGGUNA -->
        <div id="pengguna" class="hidden row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="menu-card" onclick="window.location='{{ route('karyawan') }}'">
                    <i class="bi bi-person-badge menu-icon"></i>
                    <h5>Manajemen Karyawan</h5>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="menu-card" onclick="window.location='{{ route('kurir.index') }}'">
                    <i class="bi bi-truck menu-icon"></i>
                    <h5>Manajemen Kurir</h5>
                </div>
            </div>
        </div>

        <!-- MANAJEMEN LAUNDRY -->
        <div id="laundry" class="hidden row justify-content-center">
            <div class="col-md-4 mb-4">
                <div class="menu-card" onclick="window.location='{{ route('layanan.index') }}'">
                    <i class="bi bi-list-task menu-icon"></i>
                    <h5>Kelola Layanan</h5>
                </div>
            </div>

            <div class="col-md-4 mb-4">
                <div class="menu-card" onclick="window.location='{{ route('laporan.index') }}'">
                    <i class="bi bi-graph-up menu-icon"></i>
                    <h5>Lihat Laporan</h5>
                </div>
            </div>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        const backBtn = document.getElementById("backBtn");
        const dashboard = document.getElementById("dashboard");
        const pengguna = document.getElementById("pengguna");
        const laundry = document.getElementById("laundry");

        function showDashboard() {
            dashboard.classList.remove('hidden');
            pengguna.classList.add('hidden');
            laundry.classList.add('hidden');
            backBtn.classList.add("hidden");
        }

        function showPengguna() {
            dashboard.classList.add('hidden');
            pengguna.classList.remove('hidden');
            laundry.classList.add('hidden');
            backBtn.classList.remove("hidden");
        }

        function showLaundry() {
            dashboard.classList.add('hidden');
            pengguna.classList.add('hidden');
            laundry.classList.remove('hidden');
            backBtn.classList.remove("hidden");
        }

        // Handle URL ?tab=
        const tab = new URLSearchParams(window.location.search).get('tab');
        if (tab === 'pengguna') showPengguna();
        else if (tab === 'laundry') showLaundry();
        else showDashboard();
    </script>

</body>

</html>