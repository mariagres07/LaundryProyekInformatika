<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kurir - IVA Laundry</title>

    <!-- Cek role -->
    @if (session('role') !== 'kurir')
    <script>window.location.href = "{{ route('login.show') }}";</script>
    @endif

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Bootstrap Icons -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

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

        <!-- Navbar -->
        <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4 rounded shadow-sm">
            <div class="container-md">
                <a class="navbar-brand fw-bold text-primary" href="#">IVA Laundry</a>
                {{-- <a href="{{ route('logout') }}" class="btn btn-danger">Keluar</a> --}}
            </div>
        </nav>

        <!-- Dashboard Utama -->
        <div id="dashboard">
            <div class="row text-center justify-content-center">

                <!-- Verifikasi Pesanan -->
                <div class="col-md-3 mb-3">
                    <a href="/lihatverifikasi" class="text-decoration-none text-dark">
                        <div class="menu-card">
                            <i class="bi bi-list-ul" style="font-size:40px;"></i>
                            <h5 class="mt-2">Verifikasi Pesanan</h5>
                        </div>
                    </a>
                </div>

                <!-- Pesanan -->
                <div class="col-md-3 mb-3">
                    <a href="/lihatdata" class="text-decoration-none text-dark">
                        <div class="menu-card">
                            <i class="bi bi-clipboard-data" style="font-size:40px;"></i>
                            <h5 class="mt-2">Pesanan</h5>
                        </div>
                    </a>
                </div>
            </div>
        </div>
    </div>
</body>

</html>