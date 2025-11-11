<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<div class="container mt-5">
    {{-- 🔹 Pesan sukses --}}
    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>Berhasil!</strong> {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    {{-- 🔹 Pesan error validasi --}}
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="card shadow">
        <div class="card-header bg-success text-white">
            <h4 class="mb-0">Tambah Karyawan</h4>
        </div>
        <div class="card-body"> 
            <form method="POST" action="{{ url('/karyawan/store') }}">
                @csrf

                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    {{-- <input type="text" name="namaKaryawan" class="form-control" required> --}}
                     <input type="text" name="namaKaryawan" class="form-control"
                           value="{{ old('namaKaryawan') }}" required>
                    @error('namaKaryawan')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Username *</label>
                    {{-- <input type="text" name="username" class="form-control" required> --}}
                    <input type="text" name="username" class="form-control"
                           value="{{ old('username') }}" required>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP *</label>
                    {{-- <input type="text" name="noHp" class="form-control" required> --}}
                     <input type="text" name="noHp" class="form-control"
                           value="{{ old('noHp') }}" required>
                    @error('noHp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    {{-- <input type="email" name="email" class="form-control" required> --}}
                    <input type="email" name="email" class="form-control"
                           value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <div class="mb-3">
                    <label class="form-label">Password *</label>
                    {{-- <input type="password" name="password" class="form-control" required> --}}
                     <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                {{-- Konfirmasi Password --}}
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat *</label>
                    {{-- <textarea name="alamat" class="form-control" rows="3" required></textarea> --}}
                    <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat') }}</textarea>
                    @error('alamat')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <button type="submit" class="btn btn-primary">Simpan</button>
                <a href="{{ url('/karyawan') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
