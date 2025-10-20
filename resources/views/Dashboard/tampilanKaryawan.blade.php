<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>IVA Laundry - Dashboard Karyawan</title>

    {{-- Redirect jika bukan karyawan --}}
    @if (session('role') !== 'karyawan')
        <script>window.location.href = "{{ route('login.show') }}";</script>
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: linear-gradient(to bottom, #ffffff, #dbe6f4);
            background-image: url('https://i.ibb.co/YjJ4pMK/water-bg.jpg');
            background-repeat: no-repeat;
            background-position: bottom;
            background-size: cover;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
        }

        .logo {
            height: 60px;
        }

        .logout-btn {
            background: linear-gradient(to bottom, #f3f3f3, #e2e2e2);
            color: red;
            font-weight: bold;
            border: none;
            border-radius: 12px;
            padding: 6px 18px;
            transition: 0.3s;
        }

        .logout-btn:hover {
            background: #ffdddd;
        }

        .menu-container {
            margin-top: 90px;
        }

        .menu-card {
            background: #ffffffd9;
            border-radius: 10px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.15);
            text-align: center;
            padding: 25px 20px;
            transition: transform 0.2s ease-in-out, box-shadow 0.2s;
            cursor: pointer;
        }

        .menu-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 8px 16px rgba(0, 0, 0, 0.2);
        }

        .menu-icon {
            font-size: 48px;
            color: #6a9edb;
        }

        .menu-text {
            margin-top: 15px;
            font-weight: 500;
            color: #333;
        }

        footer {
            position: fixed;
            bottom: 10px;
            left: 0;
            right: 0;
            text-align: center;
            color: #324b77;
            font-size: 14px;
        }

        .social {
            margin: 0 10px;
            font-weight: 600;
        }

        .social i {
            font-size: 18px;
            vertical-align: middle;
            margin-right: 4px;
        }

        .insta {
            color: #c13584;
        }

        .wa {
            color: #25d366;
        }
    </style>
</head>

<body>
    <!-- Header -->
    <div class="container-fluid d-flex justify-content-between align-items-center p-3">
        <img src="https://i.ibb.co/z6s0fyk/logo-iva.png" alt="IVA Laundry" class="logo">

        <form action="{{ route('logout') }}" method="POST" class="m-0">
            @csrf
            <button type="submit" class="logout-btn">KELUAR</button>
        </form>
    </div>

    <!-- Menu -->
    <div class="container menu-container text-center">
        <div class="row justify-content-center g-4">
            <div class="col-6 col-md-3">
                <div class="menu-card" onclick="window.location.href='{{ route('karyawan') }}'">
                    <i class="bi bi-people menu-icon"></i>
                    <div class="menu-text">Manajemen Pengguna</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="menu-card" onclick="window.location.href='{{ route('layanan.index') }}'">
                    <i class="bi bi-washer menu-icon"></i>
                    <div class="menu-text">Manajemen Laundry</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="menu-card" onclick="window.location.href='{{ route('laporan.index') }}'">
                    <i class="bi bi-list-check menu-icon"></i>
                    <div class="menu-text">Pesanan</div>
                </div>
            </div>

            <div class="col-6 col-md-3">
                <div class="menu-card" onclick="window.location.href='{{ route('pengaduan.index') }}'">
                    <i class="bi bi-file-earmark-text menu-icon"></i>
                    <div class="menu-text">Pengaduan</div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer>
        <span class="social insta"><i class="bi bi-instagram"></i>iva.laundry</span>
        <span class="social wa"><i class="bi bi-whatsapp"></i>iva.laundry</span>
    </footer>
</body>

</html>
