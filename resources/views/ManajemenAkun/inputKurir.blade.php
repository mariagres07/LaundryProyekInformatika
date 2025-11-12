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
        #password-rules {
            font-size: 13px;
            margin-bottom: 5px;
            list-style: none;
            padding-left: 0;
        }

        #password-rules li {
            color: #b42318;
            transition: all 0.3s;
            display: flex;
            align-items: center;
        }

        #password-rules li.valid {
            color: #2e7d32;
            opacity: 0.6;
        }

        #password-rules li::before {
            content: "☐";
            margin-right: 6px;
            font-size: 14px;
        }

        #password-rules li.valid::before {
            content: "☑";
        }

        /* Gaya label dan input agar rapi satu kolom */
        .form-label {
            font-weight: 500;
            color: #444;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
        }

        .form-control:focus {
            border-color: #4a8fe7;
            box-shadow: 0 0 0 3px rgba(74, 143, 231, 0.1);
        }

        /* Spasi antar field */
        .mb-3 {
            margin-bottom: 1.2rem !important;
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

                <!-- Nama Lengkap -->
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="namaKurir" class="form-control" value="{{ old('namaKurir') }}" required>
                    @error('namaKurir')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Username -->
                <div class="mb-3">
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username') }}" required>
                    @error('username')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- No HP -->
                <div class="mb-3">
                    <label class="form-label">No HP *</label>
                    <input type="tel" name="noHp" class="form-control" maxlength="12" pattern="[0-9]{1,12}" title="Masukkan maksimal 12 digit angka." value="{{ old('noHp') }}" required>
                    <small class="text-muted">Maksimal 12 digit angka</small>
                    @error('noHp')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Email -->
                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ old('email') }}" required>
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Password -->
                <ul id="password-rules">
                    <li id="rule-length">Minimal 8 karakter</li>
                    <li id="rule-upper">Mengandung huruf besar (A-Z)</li>
                    <li id="rule-lower">Mengandung huruf kecil (a-z)</li>
                    <li id="rule-number">Mengandung angka (0-9)</li>
                    <li id="rule-symbol">Mengandung simbol (@$!%*?&#)</li>
                </ul>
                <div class="mb-3">
                    <label class="form-label">Password *</label>
                    <input type="password" name="password" class="form-control" required>
                    @error('password')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>

                <!-- Konfirmasi Password -->
                <div class="mb-3">
                    <label class="form-label">Konfirmasi Password *</label>
                    <input type="password" name="password_confirmation" class="form-control" required>
                </div>

                <!-- SECTION ALAMAT (SATU KOLOM VERTIKAL - MIRIP GAMBAR) -->
                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap *</label>
                    <div class="mt-2">
                        <!-- Jalan -->
                        <div class="mb-3">
                            <label class="form-label">Jalan *</label>
                            <input type="text" name="alamat_jalan" class="form-control" placeholder="Contoh: Jl. Merdeka" value="{{ old('alamat_jalan') }}" required>
                            @error('alamat_jalan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Blok -->
                        <div class="mb-3">
                            <label class="form-label">Blok *</label>
                            <input type="text" name="alamat_blok" class="form-control" placeholder="Contoh: A12" value="{{ old('alamat_blok') }}" required>
                            @error('alamat_blok')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- RT -->
                        <div class="mb-3">
                            <label class="form-label">RT *</label>
                            <input type="number" name="alamat_rt" class="form-control" placeholder="Contoh: 001" min="0" max="999" value="{{ old('alamat_rt') }}" required>
                            @error('alamat_rt')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- RW -->
                        <div class="mb-3">
                            <label class="form-label">RW *</label>
                            <input type="number" name="alamat_rw" class="form-control" placeholder="Contoh: 001" min="0" max="999" value="{{ old('alamat_rw') }}" required>
                            @error('alamat_rw')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Kelurahan/Desa -->
                        <div class="mb-3">
                            <label class="form-label">Kelurahan/Desa *</label>
                            <input type="text" name="alamat_kelurahan" class="form-control" placeholder="Contoh: Cibuntu" value="{{ old('alamat_kelurahan') }}" required>
                            @error('alamat_kelurahan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Kecamatan -->
                        <div class="mb-3">
                            <label class="form-label">Kecamatan *</label>
                            <input type="text" name="alamat_kecamatan" class="form-control" placeholder="Contoh: Cibinong" value="{{ old('alamat_kecamatan') }}" required>
                            @error('alamat_kecamatan')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Kabupaten/Kota -->
                        <div class="mb-3">
                            <label class="form-label">Kabupaten/Kota *</label>
                            <input type="text" name="alamat_kabupaten" class="form-control" placeholder="Contoh: Bogor" value="{{ old('alamat_kabupaten') }}" required>
                            @error('alamat_kabupaten')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Provinsi -->
                        <div class="mb-3">
                            <label class="form-label">Provinsi *</label>
                            <input type="text" name="alamat_provinsi" class="form-control" placeholder="Contoh: Jawa Barat" value="{{ old('alamat_provinsi') }}" required>
                            @error('alamat_provinsi')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>

                        <!-- Kode Pos -->
                        <div class="mb-3">
                            <label class="form-label">Kode Pos *</label>
                            <input type="text" name="alamat_kode_pos" class="form-control" placeholder="Contoh: 16912" maxlength="5" pattern="[0-9]{5}" value="{{ old('alamat_kode_pos') }}" required>
                            <small class="text-muted">Hanya 5 digit angka</small>
                            @error('alamat_kode_pos')
                                <small class="text-danger">{{ $message }}</small>
                            @enderror
                        </div>
                    </div>
                </div>

                <!-- Tombol -->
                <div class="d-flex justify-content-between mt-4">
                    <a href="{{ url('/mkurir') }}" class="btn btn-secondary">Batal</a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    const password = document.querySelector('input[name="password"]');
    const rules = {
        length: document.getElementById('rule-length'),
        upper: document.getElementById('rule-upper'),
        lower: document.getElementById('rule-lower'),
        number: document.getElementById('rule-number'),
        symbol: document.getElementById('rule-symbol')
    };

    if (password) {
        password.addEventListener('input', function() {
            const val = password.value;
            rules.length.classList.toggle('valid', val.length >= 8);
            rules.upper.classList.toggle('valid', /[A-Z]/.test(val));
            rules.lower.classList.toggle('valid', /[a-z]/.test(val));
            rules.number.classList.toggle('valid', /[0-9]/.test(val));
            rules.symbol.classList.toggle('valid', /[@$!%*?&#]/.test(val));
        });
    }
</script>

</body>
</html>