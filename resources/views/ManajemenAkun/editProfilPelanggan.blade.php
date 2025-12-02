<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Profil Pelanggan - IVA Laundry</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Bootstrap CSS -->
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

        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(185, 215, 242, 0.9);
            z-index: -1;
        }

        .offcanvas {
            background: rgba(255, 255, 255, 0.85);
            backdrop-filter: blur(12px);
            border-right: 1px solid rgba(90, 150, 230, 0.2);
            box-shadow: 3px 0 10px rgba(0, 0, 0, 0.05);
        }

        .card-custom {
            border-radius: 15px;
            background-color: rgba(255, 255, 255, 0.95);
            padding: 30px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.1);
            backdrop-filter: blur(5px);
        }

        .profile-pic {
            width: 110px;
            height: 110px;
            border-radius: 50%;
            border: 3px solid #64b5f6;
            object-fit: cover;
            cursor: pointer;
            transition: 0.3s;
        }

        .profile-pic:hover {
            opacity: 0.7;
        }

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
            cursor: pointer;
            text-decoration: none;
        }
    </style>
</head>

<body>
    @include('Dashboard.pelanggan_sidenav')

    <!-- ====== Content ====== -->
    <div class="content">
        <div class="card-custom mt-2">
            <h3 class="title mb-3" style="color:#2F65B9;">Edit Profil</h3>

            <!-- Pesan Sukses -->
            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <!-- Upload Foto Profil -->
            <div class="text-center mb-3">
                <input type="file" id="uploadFoto" name="foto" accept="image/*" class="d-none">
                <label for="uploadFoto">
                    <img id="previewFoto"
                         src="{{ $pelanggan->foto 
                                ? asset('storage/foto_pelanggan/'.$pelanggan->foto)
                                : 'https://cdn-icons-png.flaticon.com/512/149/149071.png' }}"
                         class="profile-pic"
                         alt="Foto Profil">
                </label>
            </div>

            <!-- Form Edit Profil -->
            <form action="{{ route('pelanggan.update') }}" method="POST" enctype="multipart/form-data" class="mt-3" id="editForm">
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
                        <input type="email" 
                               name="email" 
                               class="form-control" 
                               value="{{ old('email', $pelanggan->email ?? '') }}" 
                               required
                               id="emailInput"
                               pattern="[a-zA-Z0-9._%+-]+@(gmail\.com|yahoo\.com)$"
                               title="Email harus berakhir dengan @gmail.com atau @yahoo.com">
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Alamat</label>
                        <input type="text" name="alamat" class="form-control"
                            value="{{ old('alamat', $pelanggan->alamat ?? '') }}" required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Nomor HP</label>
                        <input type="text" 
                               name="noHp" 
                               class="form-control" 
                               value="{{ old('noHp', $pelanggan->noHp ?? '') }}" 
                               maxlength="12" 
                               pattern="\d{10,12}" 
                               title="Nomor HP harus 10–12 digit angka, tanpa spasi atau tanda baca"
                               inputmode="numeric"
                               required>
                    </div>

                    <div class="col-md-6">
                        <label class="form-label">Password Baru</label>
                        <input type="password" name="password" class="form-control">
                        <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                    </div>
                </div>

                <div class="text-end mt-4">
                    <a href="{{ url()->previous() }}" class="btn btn-secondary me-2">Batal</a>
                    <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ url()->previous() }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Script: Preview Foto -->
    <script>
        document.getElementById('uploadFoto').addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(event) {
                    document.getElementById('previewFoto').src = event.target.result;
                };
                reader.readAsDataURL(file);
            }
        });
    </script>

    <!-- Script: Validasi Email & Nomor HP -->
    <script>
        // Validasi email: hanya @gmail.com atau @yahoo.com
        document.getElementById('emailInput').addEventListener('input', function(e) {
            const email = e.target.value.trim();
            const allowedDomains = ['@gmail.com', '@yahoo.com'];
            const isValid = allowedDomains.some(domain => email.endsWith(domain));

            const input = e.target;
            if (email !== '' && !isValid) {
                input.setCustomValidity('Email hanya boleh menggunakan @gmail.com atau @yahoo.com');
            } else {
                input.setCustomValidity('');
            }
        });

        // Hanya izinkan angka di input nomor HP
        document.querySelector('input[name="noHp"]').addEventListener('input', function(e) {
            e.target.value = e.target.value.replace(/\D/g, '');
        });
    </script>
</body>
</html>