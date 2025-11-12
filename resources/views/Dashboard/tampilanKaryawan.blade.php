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

        /* ==== HEADER WATER FRAME ==== */
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
            text-align: left;
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.35);
        }

        /* ===== WELCOME TEXT ===== */
        .welcome-text {
            margin-left: 40px;
            margin-bottom: 25px;
            color: #2d4b74;
            font-size: 22px;
            font-weight: 600;
        }

        .hidden {
            display: none !important;
        }

        .menu-card {
            background-color: #ffffff;
            border-radius: 15px;
            padding: 30px 20px;
            text-align: center;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s, box-shadow 0.2s;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 14px rgba(0, 0, 0, 0.15);
        }

        .menu-icon {
            font-size: 50px;
            color: #7ba6e0;
            margin-bottom: 15px;
        }

        footer {
            text-align: center;
            padding: 15px 0;
            font-weight: 600;
            color: #2d4b74;
        }

        .logout-btn {
            background-color: #dce3e8;
            color: red;
            font-weight: bold;
            border-radius: 12px;
            padding: 8px 20px;
            border: none;
            width: 100%;
            text-align: center;
            margin-top: 15px;
        }

        .logout-btn:hover {
            background-color: #f8d7da;
            color: #a00;
        }

        /* === Tombol Kembali (Floating Button) === */
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
            transition: 0.3s;
            cursor: pointer;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
        }

        .btn-back:hover {
            background-color: #6fa2cc;
            transform: scale(1.1);
        }
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header-wrapper">
        <div class="header-bg"></div>
        <div class="header-content">
            Welcome! <span>{{ session('username') ?? 'Karyawan' }}</span>
        </div>
    </div>

    <div class="container py-4">

        <!-- === Dashboard === -->
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
                <a href="{{ route('pengaduan.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-chat-dots menu-icon"></i>
                        <h5>Pengaduan</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3 mb-4">
                <a href="{{ url('/lihatdata') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-eye-fill menu-icon"></i>
                        <h5>Lihat Data Pesanan</h5>
                    </div>
                </a>
            </div>
        </div>

        <!-- === Manajemen Pengguna === -->
        <div id="pengguna" class="hidden row justify-content-center py-4">
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

            <!-- Tombol kembali -->
            <button class="btn-back" onclick="showDashboard()" title="Kembali ke Dashboard">
                <i class="bi bi-arrow-left"></i>
            </button>
        </div>

        <!-- === Manajemen Laundry === -->
        <div id="laundry" class="hidden row justify-content-center py-4">
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

            <!-- Tombol kembali -->
            <button class="btn-back" onclick="showDashboard()" title="Kembali ke Dashboard">
                <i class="bi bi-arrow-left"></i>
            </button>
        </div>

    </div>

    <!-- Footer -->
    <footer>
        <i class="bi bi-instagram text-danger"></i> iva.laundry &nbsp; | &nbsp;
        <i class="bi bi-whatsapp text-success"></i> iva.laundry
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Base URL untuk digunakan di file JS -->
    <script>
        // === Fungsi Navigasi ===
        function showDashboard() {
            document.getElementById('dashboard').classList.remove('hidden');
            document.getElementById('pengguna').classList.add('hidden');
            document.getElementById('laundry').classList.add('hidden');
        }

        function showPengguna() {
            document.getElementById('dashboard').classList.add('hidden');
            document.getElementById('pengguna').classList.remove('hidden');
            document.getElementById('laundry').classList.add('hidden');
        }

        function showLaundry() {
            document.getElementById('dashboard').classList.add('hidden');
            document.getElementById('pengguna').classList.add('hidden');
            document.getElementById('laundry').classList.remove('hidden');
        }

        // === Deteksi tab dari URL ===
        const urlParams = new URLSearchParams(window.location.search);
        const initialTab = urlParams.get('tab');

        if (initialTab === 'pengguna') {
            showPengguna();
        } else if (initialTab === 'laundry') {
            showLaundry();
        } else {
            showDashboard();
        }
    </script>

    <!-- File JS utama -->
    <script src="{{ asset('js/dashboard.js') }}"></script>

</body>
</html>
