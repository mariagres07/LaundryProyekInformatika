<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Beranda Pelanggan - IVA Laundry</title>

    @if (session('role') !== 'pelanggan')
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
    @include('Dashboard.pelanggan_sidenav') <div class="container py-4 text-center position-relative"
        style="min-height: 90vh;">
        <div class="d-flex justify-content-between align-items-center mb-5">
            <img src="https://i.ibb.co/GHR6mt3/iva-laundry-logo.png" alt="IVA Laundry" class="logo">
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="btn logout-btn">KELUAR</button>
            </form>
        </div>

        <div id="pesanlaundry" class="row justify-content-center mt-5">
            <h3>Pesan Laundry (Halaman Pesan Laundry)</h3>
            <div class="col-md-3 mb-4">
                <div class="menu-card" onclick="window.location.href='/pesanLaundry'">
                    <i class="bi bi-washer menu-icon" style="font-size:40px;"></i>
                    <h5>Pesan Laundry</h5>
                </div>
            </div>
        </div>

        <div id="lihatdatapesanan" class="hidden row justify-content-center mt-5">
            <h3>Lihat Data Pesanan (Halaman Pesanan Anda)</h3>
            <div class="col-md-3 mb-4">
                <div class="menu-card" onclick="window.location.href='/detailPesanan'">
                    <i class="bi bi-file-text menu-icon" style="font-size:40px;"></i>
                    <h5>Lihat Data Pesanan</h5>
                </div>
            </div>
        </div>

        <div id="editprofil" class="hidden row justify-content-center mt-5">
            <h3>Edit Profil (Halaman Pengaturan Akun)</h3>
            <div class="col-md-3 mb-4">
                <div class="menu-card" onclick="window.location.href='/editprofil'">
                    <i class="bi bi-people-fill menu-icon"></i>
                    <h5>Edit Profil</h5>
                </div>
            </div>
        </div>

        <footer>
            <div><i class="bi bi-instagram text-danger"></i>iva.laundry</div>
            <div><i class="bi bi-whatsapp text-success"></i>iva.laundry</div>
        </footer>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard_pelanggan.js') }}"></script>
    <script>
    // LOGIKA PEMUATAN TAB OTOMATIS
    const urlParams = new URLSearchParams(window.location.search);
    const initialTab = urlParams.get('tab');

    // Tentukan fungsi JS mana yang akan dijalankan saat halaman dimuat
    if (initialTab === 'pesanlaundry') {
        showPesanLaundry();
    } else if (initialTab === 'lihatdatapesanan') {
        showLihatDataPesanan();
    } else if (initialTab === 'editprofil') {
        showEditProfil();
    } else {
        // Default ke tab Pesan Laundry jika tidak ada parameter
        showPesanLaundry();
    }
    </script>
</body>

</html>