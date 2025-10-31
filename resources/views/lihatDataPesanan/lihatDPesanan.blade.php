<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Lihat Data Pesanan - IVA Laundry</title>

    @if (session('role') !== 'pelanggan')
    <script>
        window.location.href = "{{ route('login.show') }}";
    </script>
    @endif

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
        }

        h2 {
            text-align: center;
            font-weight: 700;
            color: #2d4b74;
            margin-top: 40px;
            margin-bottom: 30px;
        }

        .pesanan-card {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #dbe8ec;
            border-radius: 40px;
            padding: 18px 25px;
            margin-bottom: 15px;
            transition: all 0.3s ease;
            box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
        }

        .pesanan-card:hover {
            transform: translateY(-3px);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }

        .pesanan-info h5 {
            color: #4273b8;
            font-weight: 600;
            margin-bottom: 5px;
        }

        .pesanan-info small {
            color: #d65a50;
            font-weight: 500;
        }

        .status {
            padding: 6px 18px;
            border-radius: 12px;
            font-weight: 600;
            font-size: 0.9rem;
            border: none;
        }

        .status-proses {
            background-color: #f4b400;
            color: white;
        }

        .status-diantar {
            background-color: #64b5f6;
            color: white;
        }

        .status-selesai {
            background-color: #8bc34a;
            color: white;
        }

        /* 🔹 Tombol kembali di pojok kiri bawah */
        .btn-back {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background-color: #4273b8;
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
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
        }

        .btn-back:hover {
            background-color: #315b94;
            transform: scale(1.08);
        }
    </style>
</head>

<body>

    {{-- Include sidebar --}}
    @include('Dashboard.pelanggan_sidenav')

    <div class="container">
        <h2>Lihat Data Pesanan</h2>

        <!-- Contoh Pesanan -->
        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>Maria Petra</h5>
                <small>01/05/2025</small>
            </div>
            <span class="status status-proses">Proses</span>
        </div>

        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>Maria Petra</h5>
                <small>28/04/2025</small>
            </div>
            <span class="status status-diantar">Diantar</span>
        </div>

        <div class="pesanan-card">
            <div class="pesanan-info">
                <h5>Maria Petra</h5>
                <small>24/04/2025</small>
            </div>
            <span class="status status-selesai">Selesai</span>
        </div>
    </div>

    <!--Tombol kembali di pojok kiri bawah -->
    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>