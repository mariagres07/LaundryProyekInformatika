<!-- resources/views/dashboard/kurir_nav_sidebar.blade.php -->

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

<!-- Navbar -->
<nav class="navbar navbar-light bg-light shadow-sm">
    <div class="container-fluid">
        <button class="btn btn-primary" type="button" data-bs-toggle="offcanvas" data-bs-target="#sidebar"
            aria-controls="sidebar">
            <i class="bi bi-list"></i>
        </button>
        <span class="navbar-brand mb-0 h1">IVA Laundry - Kurir</span>
    </div>
</nav>

<!-- Sidebar Offcanvas -->
<div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body d-flex flex-column">
        <a href="{{ url('/tampilanKurir') }}">
            <i class="bi bi-list-ul"></i> Dashboard
        </a>
        <a href="{{ url('/lihatverifikasi') }}">
            <i class="bi bi-list-ul"></i> Verifikasi Pesanan
        </a>
        <a href="{{ route('lihatdata.index') }}">
            <i class="bi bi-clipboard-data"></i> Pesanan
        </a>

        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="logout-btn">KELUAR</button>
        </form>
    </div>
</div>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>