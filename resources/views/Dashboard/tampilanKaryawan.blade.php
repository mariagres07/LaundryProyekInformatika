<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry</title>

    <!-- Cek role -->
    @if (session('role') !== 'karyawan')
        <script>window.location.href = "{{ route('login.show') }}";</script>
    @endif
    
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f7f7f7;
        }

        .menu-card {
            text-align: center;
            padding: 30px 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            transition: transform 0.2s, box-shadow 0.2s;
        }

        .menu-card:hover {
            transform: scale(1.05);
            box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
        }

        .hidden {
            display: none;
        }
    </style>
</head>

<body>

    <div class="container py-4">

        <!-- Header -->
        {{-- <div class="d-flex justify-content-between mb-3"> --}}
        {{-- <h3>IVA Laundry</h3> --}}
        {{-- <a href="{{ route('logout') }}" class="btn btn-danger">KELUAR</a> --}}
        {{-- </div> --}}

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
            <div class="container-md">
                <a class="navbar-brand" href="#">Iva Laundry</a>
            </div>
        </nav>

        <!-- Tombol kembali -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

        <!-- Halaman Dashboard -->
        <div id="dashboard">
            <div class="row text-center justify-content-center">
                <!-- Manajemen Pengguna -->
                <div class="col-md-3 mb-3">
                    <div class="menu-card" onclick="showPengguna()">
                        <i class="bi bi-people" style="font-size:40px;"></i>
                        <h5>Manajemen Pengguna</h5>
                    </div>
                </div>

                <!-- Manajemen Laundry -->
                <div class="col-md-3 mb-3">
                    <div class="menu-card" onclick="showLaundry()">
                        <i class="bi bi-washer" style="font-size:40px;"></i>
                        <h5>Manajemen Laundry</h5>
                    </div>
                </div>

                <!-- Pesanan -->
                <div class="col-md-3 mb-3">
                    <a href="{{ route('laporan.index') }}" class="text-decoration-none text-dark">
                        <div class="menu-card">
                            <i class="bi bi-list-check" style="font-size:40px;"></i>
                            <h5 class="mt-2">Pesanan</h5>
                        </div>
                    </a>
                </div>

                <!-- Pengaduan -->
                <div class="col-md-3 mb-3">
                    <a href="{{ route('pengaduan.index') }}" class="text-decoration-none text-dark">
                        <div class="menu-card">
                            <i class="bi bi-list-check" style="font-size:40px;"></i>
                            <h5 class="mt-2">Pengaduan</h5>
                        </div>
                    </a>
                </div>
                </a>
            </div>
        </div>
    </div>

    <!-- Halaman Manajemen Pengguna -->
    <div id="pengguna" class="hidden">
        <div class="card mb-4">
            <div class="card-body text-center"
                style="background:url('https://i.ibb.co/YjJ4pMK/water-bg.jpg') no-repeat center; background-size:cover; color:#fff;">
                <h3>Manajemen Pengguna</h3>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center">
            <a href="{{ route('karyawan') }}" class="btn btn-primary mb-3 w-50 rounded-pill"> MANAJEMEN KARYAWAN</a>
            <a href="{{ route('kurir.index') }}" class="btn btn-info w-50 rounded-pill"> MANAJEMEN KURIR </a>
            <button class="btn btn-secondary mt-3 w-25 rounded-pill" onclick="showDashboard()"> Kembali </button>
        </div>
    </div>

    <!-- Halaman Manajemen Laundry -->
    <div id="laundry" class="hidden">
        <div class="card mb-4">
            <div class="card-body text-center"
                style="background:url('https://i.ibb.co/YjJ4pMK/water-bg.jpg') no-repeat center; background-size:cover; color:#fff;">
                <h3>Manajemen Laundry</h3>
            </div>
        </div>

        <div class="d-flex flex-column align-items-center">
            <a href="{{ route('layanan.index') }}" class="btn btn-primary mb-3 w-50 rounded-pill">KELOLA LAYANAN</a>
            <a href="{{ route('laporan.index') }}" class="btn btn-info w-50 rounded-pill">LIHAT LAPORAN</a>
            <button class="btn btn-secondary mt-3 w-25 rounded-pill" onclick="showDashboard()">Kembali</button>
        </div>
    </div>

    </div>

    <script>
        function showPengguna() {
            document.getElementById('dashboard').classList.add('hidden');
            document.getElementById('pengguna').classList.remove('hidden');
        }

        function showLaundry() {
            document.getElementById('dashboard').classList.add('hidden');
            document.getElementById('laundry').classList.remove('hidden');
        }

        function showDashboard() {
            document.getElementById('pengguna').classList.add('hidden');
            document.getElementById('laundry').classList.add('hidden');
            document.getElementById('dashboard').classList.remove('hidden');
        }
    </script>

</body>

</html>