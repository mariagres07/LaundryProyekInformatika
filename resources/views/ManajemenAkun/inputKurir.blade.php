<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Edit Profil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
    body {
        background: #f6f9ff;
    }

    .card {
        border-radius: 12px;
        background-color: #fff;
        padding: 2rem;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    .card-title {
        text-align: left;
        font-weight: bold;
        font-size: 42px;
        margin-bottom: 20px;
        color: #2d7cff;
    }

    .form-group {
        margin-bottom: 1.5rem;
    }

    .form-label {
        font-weight: 500;
        margin-bottom: 0.5rem;
        color: #444;
    }

    .form-control {
        border-radius: 8px;
        border: 1px solid #ddd;
        padding: 0.75rem 1rem;
        font-size: 1rem;
    }

    .form-control:focus {
        border-color: #4a8fe7;
        box-shadow: 0 0 0 3px rgba(74, 143, 231, 0.1);
    }

    .row {
        margin-right: 0;
        margin-left: 0;
    }

    .col-md-6 {
        padding-right: 0.75rem;
        padding-left: 0.75rem;
    }

    .container-fluid {
        padding: 2rem;
    }

    .btn-save {
        background-color: #2d7cff;
        color: white;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        transition: background-color 0.3s;
    }

    .btn-save:hover {
        background-color: #3a5a80;
    }

    .btn-cancel {
        background-color: #f1f3f5;
        color: #495057;
        border: none;
        border-radius: 8px;
        padding: 0.75rem 1.5rem;
        font-weight: 500;
        margin-right: 12px;
        transition: background-color 0.3s;
    }

    .btn-cancel:hover {
        background-color: #e9ecef;
    }

    .help-text {
        font-size: 0.875rem;
        color: #6c757d;
        margin-top: 0.25rem;
    }

    /* Sembunyikan aturan password */
    #password-rules {
        display: none;
    }

    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #8ab2d3;
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
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>

<body>
    <div class="container-fluid">
        <div class="card">
            <h4 class="card-title">Input Kurir</h4>

            <form method="POST" action="{{ url('/mkurir/store') }}">
                @csrf

                <div class="row">
                    <!-- Kolom Kiri -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Nama Lengkap *</label>
                            <input type="text" name="namaKurir" class="form-control" value="{{ old('namaKurir') }}"
                                required>
                            @error('namaKurir')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">Email *</label>
                            <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                            @error('email')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label class="form-label">No HP *</label>
                            <input type="tel" name="noHp" class="form-control" maxlength="12" pattern="[0-9]{1,12}"
                                title="Masukkan maksimal 12 digit angka." value="{{ old('noHp') }}" required>
                            <small class="text-muted">Maksimal 12 digit angka</small>
                            @error('noHp')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>

                    <!-- Kolom Kanan -->
                    <div class="col-md-6">
                        <div class="form-group">
                            <label class="form-label">Username *</label>
                            <input type="text" name="username" class="form-control" value="{{ old('username') }}"
                                required>
                            @error('username')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Password Baru -->
                        <div class="form-group">
                            <label class="form-label">Password Baru</label>
                            <input type="password" name="password" class="form-control">
                            <small class="help-text">Kosongkan jika tidak ingin mengganti password</small>
                            @error('password')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Konfirmasi Password -->
                        <div class="form-group">
                            <label class="form-label">Konfirmasi Password *</label>
                            <input type="password" name="password_confirmation" class="form-control" required>
                        </div>

                        <!-- Alamat Lengkap (satu field, seperti form karyawan) -->
                        <div class="form-group">
                            <label class="form-label">Alamat Lengkap *</label>
                            <textarea name="alamat" class="form-control" rows="4"
                                required>{{ old('alamat') }}</textarea>
                            <small class="text-muted">Mohon masukkan alamat lengkap (jalan, nomor rumah, RT/RW,
                                kelurahan, kecamatan, kabupaten/kota, provinsi, kode pos)</small>
                            @error('alamat')
                            <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="d-flex justify-content-end mt-4">
                    <a href="{{ url('/mkurir') }}" class="btn btn-cancel">Batal</a>
                    <button type="submit" class="btn btn-save">Simpan Perubahan</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Tombol kembali -->
    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>
</body>

</html>