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
    body {
        font-family: 'Poppins', sans-serif;
        background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
        min-height: 100vh;
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
    </style>
</head>

<body>
    @include('Dashboard.karyawan_sidenav')

    <div class="container py-4">
        <!-- Dashboard -->
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
            {{-- <div class="col-md-3 mb-4">
                <a href="{{ route('laporan.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-list-check menu-icon"></i>
                        <h5>Pesanan</h5>
                    </div>
                </a>
            </div> --}}
            <div class="col-md-3 mb-4">
                <a href="{{ route('pengaduan.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-chat-dots menu-icon"></i>
                        <h5>Pengaduan</h5>
                    </div>
                </a>
            </div>
        </div>

        <!-- Manajemen Pengguna -->
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
        </div>

        <!-- Manajemen Laundry -->
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
        </div>
    </div>

<!-- Pengaduan -->
<div id="pengaduan" class="hidden row justify-content-center py-4">
    <div class="col-md-8">
        <div class="card shadow-sm p-4">
            <h4 class="mb-3"><i class="bi bi-chat-dots"></i> Daftar Pengaduan</h4>
            <a href="{{ route('pengaduan.index') }}" class="btn btn-primary mb-3">Lihat Semua Pengaduan</a>
        </div>
    </div>
</div>


    <!-- Footer -->
    <footer>
        <i class="bi bi-instagram text-danger"></i> iva.laundry &nbsp; | &nbsp;
        <i class="bi bi-whatsapp text-success"></i> iva.laundry
    </footer>

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    function showPengguna() {
        document.getElementById('dashboard').classList.add('hidden');
        document.getElementById('pengguna').classList.remove('hidden');
        document.getElementById('laundry').classList.add('hidden');
    }

    function showLaundry() {
        document.getElementById('dashboard').classList.add('hidden');
        document.getElementById('laundry').classList.remove('hidden');
        document.getElementById('pengguna').classList.add('hidden');
    }

    function showDashboard() {
        document.getElementById('dashboard').classList.remove('hidden');
        document.getElementById('pengguna').classList.add('hidden');
        document.getElementById('laundry').classList.add('hidden');
    }

    function showPengaduan() {
    document.getElementById('dashboard')?.classList.add('hidden');
    document.getElementById('pengguna')?.classList.add('hidden');
    document.getElementById('laundry')?.classList.add('hidden');
    document.getElementById('pengaduan')?.classList.remove('hidden');
}
    </script>
</body>

</html>