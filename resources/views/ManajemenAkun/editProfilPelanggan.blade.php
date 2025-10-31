<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Pelanggan - IVA Laundry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f5f7fb;
            font-family: 'Poppins', sans-serif;
        }

        .sidebar {
            background-color: #2F65B9;
            min-height: 100vh;
            color: #fff;
            padding-top: 40px;
            position: fixed;
            width: 240px;
        }

        .sidebar a {
            color: #cfd8ef;
            text-decoration: none;
            display: block;
            padding: 12px 20px;
            border-radius: 8px;
            margin: 5px 15px;
            transition: 0.3s;
        }

        .sidebar a.active,
        .sidebar a:hover {
            background-color: #1E4FA3;
            color: #fff;
        }

        .content {
            margin-left: 260px;
            padding: 40px;
        }

        .card-custom {
            border-radius: 15px;
            background-color: #fff;
            padding: 30px;
            box-shadow: 0 4px 10px rgba(0,0,0,0.1);
        }

        .title {
            font-weight: 600;
            color: #2F65B9;
            margin-bottom: 25px;
            font-size: 24px;
        }

        .profile-pic {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            border: 3px solid #2F65B9;
            object-fit: cover;
            margin-bottom: 15px;
        }

        .btn-primary {
            background-color: #2F65B9;
            border: none;
            padding: 10px 20px;
            font-weight: 500;
            border-radius: 8px;
        }

        .btn-primary:hover {
            background-color: #1E4FA3;
        }

        .form-label {
            font-weight: 500;
            color: #333;
        }
    </style>
</head>

<body>
    <!-- Sidebar -->
    <div class="sidebar">
        <div class="text-center mb-4">
            <img src="https://cdn-icons-png.flaticon.com/512/3135/3135715.png" width="60" class="mb-2" alt="User Icon">
            <h5>{{ $pelanggan->namaPelanggan ?? 'Pelanggan' }}</h5>
        </div>
        <a href="{{ route('dashboard.pelanggan') }}">🏠 Dashboard</a>
        <a href="{{ route('pelanggan.edit') }}" class="active">👤 Profile</a>
        <a href="#">🧺 Pesanan Saya</a>
        <a href="#">📦 Status Laundry</a>
        <a href="#">⚙️ Pengaturan</a>
        <a href="{{ route('logout') }}" style="color:#f8d7da;">🚪 Logout</a>
    </div>

    <!-- Content -->
    <div class="content">
        <div class="card-custom">
            <h3 class="title">Edit Profil</h3>

            {{-- Pesan sukses --}}
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
                    <button type="submit" class="btn btn-primary">💾 Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
