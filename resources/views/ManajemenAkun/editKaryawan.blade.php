<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
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
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
      text-decoration: none;
    }

    </style>
</head>
<body>

<div class="container d-flex justify-content-center align-items-center min-vh-100">
    <div class="card shadow p-4" style="max-width: 600px; width: 100%;">
        <h4 class="card-title">Edit Karyawan</h4>
        <div class="card-body">
            <form method="POST" action="{{ url('/karyawan/update/'.$karyawan->idKaryawan) }}"> <!-- Pastikan route sesuai -->
                @csrf
                @method('PUT')
                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="namaKaryawan" class="form-control" value="{{ old('namaKaryawan', $karyawan->namaKaryawan ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-control" value="{{ old('username', $karyawan->username ?? '') }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP *</label>
                    <input type="tel" name="noHp" class="form-control" maxlength="12" pattern="[0-9]{1,12}" title="Masukkan maksimal 12 digit angka." value="{{ old('noHp',$karyawan->noHp ?? '') }}" required>
                    <small class="text-muted">Maksimal 12 digit angka</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control 
                    @error('email') is-invalid @enderror" 
                    value="{{ old('email', $karyawan->email ?? '') }}" required>
                    @error('email')
                    <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <ul id="password-rules">
          <li id="rule-length">Minimal 8 karakter</li>
          <li id="rule-upper">Mengandung huruf besar (A-Z)</li>
          <li id="rule-lower">Mengandung huruf kecil (a-z)</li>
          <li id="rule-number">Mengandung angka (0-9)</li>
          <li id="rule-symbol">Mengandung simbol (@$!%*?&#)</li>
        </ul>
                <div class="mb-3">
                    <label class="form-label">Password</label>
                    <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak diubah">
                    <small class="text-muted">Kosongkan jika tidak ingin mengganti password</small>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat Lengkap *</label>
                    <textarea name="alamat" class="form-control" rows="4" required>{{ old('alamat', $karyawan->alamat ?? '') }}</textarea> <!-- Ubah rows dan placeholder -->
                    <small class="text-muted">Mohon masukkan alamat lengkap (jalan, nomor rumah, RT/RW, kelurahan, kecamatan, kabupaten/kota, provinsi, kode pos)</small>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="{{ url('/karyawan') }}" class="btn btn-secondary">Batal</a> <!-- Pastikan link kembali sesuai -->
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>
    const password = document.querySelector('input[name="password"]'); // Ganti selector agar lebih umum
    const rules = {
      length: document.getElementById('rule-length'),
      upper: document.getElementById('rule-upper'),
      lower: document.getElementById('rule-lower'),
      number: document.getElementById('rule-number'),
      symbol: document.getElementById('rule-symbol')
    };

    // Hanya aktifkan validasi password jika input password aktif
    if (password) {
        password.addEventListener('input', function() {
          const val = password.value;
          // Jangan validasi jika password kosong (karena opsional)
          if (val === '') {
              Object.values(rules).forEach(rule => rule.classList.remove('valid'));
              return;
          }
          rules.length.classList.toggle('valid', val.length >= 8);
          rules.upper.classList.toggle('valid', /[A-Z]/.test(val));
          rules.lower.classList.toggle('valid', /[a-z]/.test(val));
          rules.number.classList.toggle('valid', /[0-9]/.test(val));
          rules.symbol.classList.toggle('valid', /[@$!%*?&#]/.test(val));
        });
    }


    function togglePassword(id, el) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        el.classList.remove("fa-eye");
        el.classList.add("fa-eye-slash");
      } else {
        input.type = "password";
        el.classList.remove("fa-eye-slash");
        el.classList.add("fa-eye");
      }
    }
  </script>
  <a href="{{ url()->previous() }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>
</body>
</html>