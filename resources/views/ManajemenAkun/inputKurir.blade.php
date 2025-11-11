<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Input Kurir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background: url('/water.jpg') no-repeat center center fixed;
            background-size: cover;
        }
        .card {
            border-radius: 12px;
            background-color: #fff; 
        }
        .card-title {
            text-align: center;
            font-weight: bold;
            font-size: 24px;
            margin-bottom: 20px;
        }
    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="max-width: 600px; width:100%;">
        <h4 class="card-title">Input Kurir</h4>
        <div class="card-body">
            <form method="POST" action="{{ url('/mkurir/store') }}">
                @csrf
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    {{-- <input type="text" name="namaKurir" class="form-control" required> --}}
                    <input type="text" name="namaKurir" class="form-control" value="{{ old('namaKurir') }}" required>
                    @error('namaKurir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Username *</label>
                    {{-- <input type="text" name="username" class="form-control" required> --}}
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">No HP *</label>
                    {{-- <input type="text" name="noHp" class="form-control" required> --}}
                    <input type="text" name="noHp" class="form-control" value="{{ old('noHp') }}" required>
                    @error('noHp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    {{-- <input type="email" name="email" class="form-control" required> --}}
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
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

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/mkurir') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

</body>
</html>
