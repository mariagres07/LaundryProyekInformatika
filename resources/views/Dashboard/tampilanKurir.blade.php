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

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
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


    <!-- Content -->
    <div class="container py-4">
        <div id="dashboard" class="row justify-content-center">
            <div class="col-md-4 mb-4">
                <a href="{{ url('/lihatverifikasi') }}" class="text-decoration-none text-dark">
                    <div class="menu-card text-center p-4">
                        <i class="bi bi-list-check menu-icon"></i>
                        <h5 class="mt-2">Verifikasi Pesanan</h5>
                    </div>
                </a>
            </div>

            <div class="col-md-4 mb-4">
                <a href="{{ url('/lihatdata') }}" class="text-decoration-none text-dark">
                    <div class="menu-card text-center p-4">
                        <i class="bi bi-list-ul menu-icon"></i>
                        <h5 class="mt-2">Pesanan</h5>
                    </div>
                </a>
            </div>
        </div>

        <footer>
            <i class="bi bi-instagram text-danger"></i> iva.laundry &nbsp; | &nbsp;
            <i class="bi bi-whatsapp text-success"></i> iva.laundry
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>