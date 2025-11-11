<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Tambah Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: url('/water.jpg') center/cover fixed;
            font-family: 'Poppins', sans-serif;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            background-attachment: fixed;
        }

        /* Overlay semi-transparan agar teks tetap jelas */
        body::before {
            content: "";
            position: absolute;
            inset: 0;
            background: rgba(255, 255, 255, 0.95);
            z-index: -1;
        }

        .form-card {
            width: 100%;
            max-width: 500px;
            padding: 30px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
            margin: 20px;
        }

        .form-card h4 {
            text-align: center;
            font-weight: 700;
            color: #333;
            margin-bottom: 25px;
        }

        .form-label {
            font-weight: 500;
            color: #444;
        }

        .form-control {
            border: 1px solid #ddd;
            border-radius: 8px;
            padding: 10px 15px;
            font-size: 1rem;
            transition: border-color 0.2s;
        }

        .form-control:focus {
            border-color: #4a8fe7;
            box-shadow: 0 0 0 3px rgba(74, 143, 231, 0.1);
        }

        .btn-primary {
            background-color: #2e7d32; /* Hijau seperti gambar */
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-primary:hover {
            background-color: #1b5e20;
            transform: translateY(-1px);
        }

        .btn-secondary {
            background-color: #6c757d;
            border: none;
            padding: 10px 20px;
            font-weight: 600;
            border-radius: 8px;
            transition: all 0.2s;
        }

        .btn-secondary:hover {
            background-color: #5a6268;
            transform: translateY(-1px);
        }

        .d-flex.justify-content-between {
            margin-top: 20px;
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

    </style>
</head>
<body>

<div class="form-card">
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

    <h4>Input Karyawan</h4>

    <form method="POST" action="{{ url('/karyawan/store') }}">
        @csrf

        <div class="mb-3">
            <label class="form-label">Nama Lengkap *</label>
            <input type="text" name="namaKaryawan" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Username *</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">No HP *</label>
            <input type="text" name="noHp" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Email *</label>
            <input type="email" name="email" class="form-control" required>
        </div>

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
        </div>

        <div class="mb-3">
            <label class="form-label">Alamat *</label>
            <textarea name="alamat" class="form-control" rows="4" required></textarea>
        </div>

        <div class="d-flex justify-content-between">
            <a href="{{ url('/karyawan') }}" class="btn btn-secondary">Batal</a>
            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    const password = document.getElementById('password');
    const rules = {
      length: document.getElementById('rule-length'),
      upper: document.getElementById('rule-upper'),
      lower: document.getElementById('rule-lower'),
      number: document.getElementById('rule-number'),
      symbol: document.getElementById('rule-symbol')
    };

    password.addEventListener('input', function() {
      const val = password.value;
      rules.length.classList.toggle('valid', val.length >= 8);
      rules.upper.classList.toggle('valid', /[A-Z]/.test(val));
      rules.lower.classList.toggle('valid', /[a-z]/.test(val));
      rules.number.classList.toggle('valid', /[0-9]/.test(val));
      rules.symbol.classList.toggle('valid', /[@$!%*?&#]/.test(val));
    });

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
</body>
</html>