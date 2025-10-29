<!DOCTYPE html>
<html lang="id">
<!-- Bootstrap 5.3 -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

<style>
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

    .offcanvas-body a {
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 10px 15px;
        margin-bottom: 8px;
        border-radius: 12px;
        text-decoration: none;
        color: #2d4b74;
        transition: 0.3s;
    }

    .offcanvas-body a:hover {
        background-color: #7ba6e0;
        color: #fff;
    }
</style>

<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid px-4 d-flex align-items-center justify-content-between">

            <!-- Tombol Toggle Sidebar -->
            <button class="btn text-white me-3" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
                aria-controls="sidebar">
                <i class="bi bi-list fs-3"></i>
            </button>

        </div>
    </nav>

    <!-- Sidebar Offcanvas -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <a href="#"><i class="bi bi-house"></i> Dashboard</a>
            <a href="#"><i class="bi bi-basket2-fill"></i> Pesan Laundry</a>
            <a href="#"><i class="bi bi-chat-dots"></i> Pengaduan</a>
            <form method="POST" action="{{ route('logout') }}" class="mt-auto">
                @csrf
                <button type="submit" class="logout-btn mt-3">Keluar</button>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>