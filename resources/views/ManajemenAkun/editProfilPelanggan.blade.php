<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Pelanggan - IVA Laundry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background: url('water.jpg') center/cover fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            position: relative;
        }

        /* Overlay biru langit semi-transparan agar teks tetap jelas */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(185, 215, 242, 0.9); /* #b9d7f2 dengan opacity 0.9 */
            z-index: -1;
        }

        /* Offcanvas Sidebar */
        .offcanvas {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(90, 150, 230, 0.2);
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.05);
        }

        .offcanvas-header h5 {
            font-weight: 600;
            color: #2d4b74;
        }

        .offcanvas-body a {
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 10px 15px;
            margin-bottom: 8px;
            border-radius: 12px;
            text-decoration: none;
            font-weight: 500;
            color: #2d4b74;
            transition: all 0.3s ease;
            font-family: 'Poppins', sans-serif;
        }

        .offcanvas-body a:hover {
            background: linear-gradient(90deg, #5fa1f2, #79b8ff);
            color: #fff;
            transform: translateX(6px);
            box-shadow: 0 3px 8px rgba(90, 150, 230, 0.2);
        }

        .content {
            padding: 40px;
        }

        .card-custom {
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
        }

        .title {
            font-weight: 600;
            color: #2F65B9;
            font-size: 24px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #64b5f6;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #8ab2d3ff !important;
            border-color: #8ab2d3ff !important;
        }

        .btn-primary:hover {
            background-color: #1E4FA3;
        }

        /* Tombol Kembali */
        .btn-back {
            position: fixed;
            bottom: 25px;
            left: 25px;
            background-color: #8ab2d3ff;
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
    </style>
</head>

<body>
    @include('Dashboard.pelanggan_sidenav')

    <!-- Offcanvas Sidebar -->
    <div class="offcanvas offcanvas-start" tabindex="-1" id="sidebar" aria-labelledby="sidebarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="sidebarLabel">Menu</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body d-flex flex-column">
            <a href="{{ route('dashboard.pelanggan') }}">
                <i class="bi bi-house-door me-2"></i> Dashboard
            </a>
            <a href="{{ route('pelanggan.edit') }}" class="active">
                <i class="bi bi-person-circle me-2"></i> Edit Profil
            </a>
            <a href="{{ route('lihatdata.index') }}">
                <i class="bi bi-bag me-2"></i> Status Laundry
            </a>
            <a href="{{ route('pengaduan.create') }}">
                <i class="bi bi-chat-left-text me-2"></i> Buat Pengaduan
            </a>

            <!-- Tombol KELUAR - Rata Tengah, Warna Merah, Lebar Penuh -->
            <form method="POST" action="{{ route('logout') }}" class="mt-3">
                @csrf
                <button type="submit" class="btn btn-outline-danger w-100 py-2 fw-bold" style="border-radius: 12px;">
                    KELUAR
                </button>
            </form>
        </div>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="card-custom mt-2">
            <h3 class="title mb-3">Edit Profil</h3>

            @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <div class="text-center">
                <img src="https://cdn-icons-png.flaticon.com/512/149/149071.png" class="profile-pic" alt="Profile Picture">
            </div>

            <form action="{{ route('pelanggan.update') }}" method="POST" class="mt-3">
                @csrf
                <div class="row g-3">
                    <div class="col-md-6">
                        <label class="form-label">Nama Lengkap</label>
                        <input type="text" name="namaPelanggan" class="form-control"
                            value="{{ old('namaPelanggan', $pelanggan->namaPelanggan ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Username</label>
                        <input type="text" name="username" class="form-control"
                            value="{{ old('username', $pelanggan->username ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" class="form-control"
                            value="{{ old('email', $pelanggan->email ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                            value="{{ old('alamat', $pelanggan->alamat ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" name="noHp" class="form-control"
                            value="{{ old('noHp', $pelanggan->noHp ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>