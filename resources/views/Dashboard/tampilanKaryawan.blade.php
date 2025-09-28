<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body { background-color: #f7f7f7; }
        .menu-card {
            text-align: center;
            padding: 20px;
            border-radius: 10px;
            background: #fff;
            box-shadow: 0 4px 8px rgba(0,0,0,0.1);
            cursor: pointer;
            transition: transform 0.2s;
        }
        .menu-card:hover { transform: scale(1.05); }
        .hidden { display: none; }
    </style>
</head>
<body>

<div class="container py-4">

    <!-- Header -->
    <div class="d-flex justify-content-between mb-3">
        <h3>IVA Laundry</h3>
        <a href="{{ route('logout') }}" class="btn btn-danger">KELUAR</a>
    </div>

    <!-- Halaman Dashboard -->
    <div id="dashboard">
        <div class="row text-center">
            <div class="col-md-3">
                <div class="menu-card" onclick="showPengguna()">
                    <i class="bi bi-people" style="font-size:40px;"></i>
                    <h5>Manajemen Pengguna</h5>
                </div>
            </div>

            <div class="col-md-3">
                <a href="{{ route('laundry.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-washer" style="font-size:40px;"></i>
                        <h5>Manajemen Laundry</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('pesanan.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-list-check" style="font-size:40px;"></i>
                        <h5>Pesanan</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-3">
                <a href="{{ route('pengaduan.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-exclamation-circle" style="font-size:40px;"></i>
                        <h5>Pengaduan</h5>
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
            <a href="{{ route('karyawan.index') }}" class="btn btn-primary mb-3 w-50">MANAJEMEN KARYAWAN</a>
            <a href="{{ route('kurir.index') }}" class="btn btn-info w-50">MANAJEMEN KURIR</a>
            <button class="btn btn-secondary mt-3 w-25" onclick="showDashboard()">Kembali</button>
        </div>
    </div>

</div>

<script>
    function showPengguna() {
        document.getElementById('dashboard').classList.add('hidden');
        document.getElementById('pengguna').classList.remove('hidden');
    }
    function showDashboard() {
        document.getElementById('pengguna').classList.add('hidden');
        document.getElementById('dashboard').classList.remove('hidden');
    }
</script>

</body>
</html>
