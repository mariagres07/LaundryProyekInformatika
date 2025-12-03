<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Kurir - IVA Laundry</title>

    @if (session('role') !== 'kurir')
    <script>
        window.location.href = "{{ route('login.show') }}";
    </script>
    @endif

    <!-- Bootstrap & Icons -->
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

        .header-wrapper {
            position: relative;
            width: 100%;
            height: 175px;
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
            text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.35);
        }

        .logout-btn {
            position: absolute;
            top: 15px;
            right: 20px;
            color: white;
            font-size: 1.5rem;
            text-decoration: none;
            transition: 0.3s;
            z-index: 2000;
        }

        .logout-btn:hover {
            opacity: 0.8;
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
    </style>
</head>

<body>

    <!-- HEADER -->
    <div class="header-wrapper">
        <div class="header-bg"></div>
        <div class="header-content">
            Welcome! <span>{{ session('username') ?? 'Kurir' }}</span>
        </div>

        <!-- Logout Button -->
        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="logout-btn">
            <i class="bi bi-box-arrow-right"></i>
        </a>
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
            @csrf
        </form>
    </div>

    <!-- DASHBOARD MENU -->
    <div class="container py-4">
        <div id="dashboard" class="row justify-content-center">

            <div class="col-md-4 mb-4">
                <a href="{{ route('lihatverifikasi.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-list-check menu-icon"></i>
                        <h5>Verifikasi Pesanan</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="{{ route('lihatdata.index') }}" class="text-decoration-none text-dark">
                    <div class="menu-card">
                        <i class="bi bi-list-ul menu-icon"></i>
                        <h5>Lihat Pesanan</h5>
                    </div>
                </a>
            </div>

        </div>
    </div>

    <footer>
        <i class="bi bi-instagram text-danger"></i> iva.laundry &nbsp; | &nbsp;
        <i class="bi bi-whatsapp text-success"></i> iva.laundry
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>