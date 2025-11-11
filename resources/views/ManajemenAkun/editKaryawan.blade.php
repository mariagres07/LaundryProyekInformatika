<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Karyawan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
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
<body class="bg-light">

<div class="container mt-5">
    <div class="card shadow">
        <div class="card-header bg-primary text-white">
            <h4 class="mb-0">Edit Karyawan</h4>
        </div>
        <div class="card-body">
            <form method="POST" action="{{ url('/karyawan/update/'.$karyawan->idKaryawan) }}">
                @csrf
                @method('PUT')


                <div class="mb-3">
                    <label class="form-label">Nama Lengkap *</label>
                    <input type="text" name="namaKaryawan" class="form-control" value="{{ $karyawan->namaKaryawan }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Username *</label>
                    <input type="text" name="username" class="form-control" value="{{ $karyawan->username }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">No HP *</label>
                    <input type="text" name="noHp" class="form-control" value="{{ $karyawan->noHp }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Email *</label>
                    <input type="email" name="email" class="form-control" value="{{ $karyawan->email }}" required>
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
                    <input type="password" name="password" class="form-control" value="{{ $karyawan->password }}" required>
                </div>

                <div class="mb-3">
                    <label class="form-label">Alamat *</label>
                    <textarea name="alamat" class="form-control" rows="3" required>{{ $karyawan->alamat }}</textarea>
                </div>

                <button type="submit" class="btn btn-success">Simpan</button>
                <a href="{{ url('/karyawan') }}" class="btn btn-secondary">Batal</a>
            </form>
        </div>
    </div>
</div>

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
