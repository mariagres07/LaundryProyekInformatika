<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Kurir</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background: #f6f9ff;
        }

        /* Container besar seperti screenshot */
        .edit-wrapper {
            background: #ffffff;
            border-radius: 20px;
            padding: 50px;
            box-shadow: 0 10px 30px rgba(0,0,0,0.08);
            max-width: 1600px;
            margin: auto;
        }

        /* Title besar kiri */
        .page-title {
            font-size: 42px;
            font-weight: 700;
            color: #2d7cff;
            margin-bottom: 40px;
        }

        /* Input lebih besar & elegan */
        .form-control, textarea {
            padding: 14px 18px;
            border-radius: 10px !important;
            font-size: 17px;
        }

        .form-label {
            font-weight: 600;
            font-size: 17px;
        }

        .btn-save {
            padding: 12px 30px;
            font-size: 18px;
        }

        #password-rules {
            font-size: 14px;
            margin-bottom: 10px;
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
            opacity: 0.7;
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
            box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
        }

        /* Tombol Batal - Warna Sama Seperti Edit Karyawan */
        .btn-cancel {
            background-color: #f1f3f5;
            color: #495057;
            border: 1px solid #dee2e6;
            border-radius: 10px;
            padding: 12px 30px;
            font-size: 18px;
            font-weight: 500;
            transition: background-color 0.2s;
        }

        .btn-cancel:hover {
            background-color: #e9ecef;
            color: #495057;
        }
    </style>
</head>

<body>

<div class="edit-wrapper">

    <h1 class="page-title">Edit Kurir</h1>

    <form method="POST" action="{{ url('/mkurir/update/'.$kurir->idKurir) }}">
        @csrf
        @method('PUT')

        <div class="row">
            <div class="col-md-6 mb-3">
                <label class="form-label">Nama Lengkap *</label>
                <input type="text" name="namaKurir" class="form-control"
                       value="{{ old('namaKurir', $kurir->namaKurir ?? '') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Username *</label>
                <input type="text" name="username" class="form-control"
                       value="{{ old('username', $kurir->username ?? '') }}" required>
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">Email *</label>
                <input type="email" name="email" class="form-control @error('email') is-invalid @enderror"
                       value="{{ old('email', $kurir->email ?? '') }}" required>
                @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="col-md-6 mb-3">
                <label class="form-label">No HP *</label>
                <input type="text" name="noHp" class="form-control"
                       value="{{ old('noHp', $kurir->noHp ?? '') }}" required>
            </div>

            <div class="col-md-12">
                <ul id="password-rules">
                    <li id="rule-length">Minimal 8 karakter</li>
                    <li id="rule-upper">Mengandung huruf besar (A-Z)</li>
                    <li id="rule-lower">Mengandung huruf kecil (a-z)</li>
                    <li id="rule-number">Mengandung angka (0-9)</li>
                    <li id="rule-symbol">Mengandung simbol (@$!%*?&#)</li>
                </ul>
            </div>

            <div class="col-md-12 mb-3">
                <label class="form-label">Password Baru</label>
                <input type="password" id="password" name="password" class="form-control"
                       placeholder="Kosongkan jika tidak diubah">
            </div>

            <div class="col-md-12 mb-4">
                <label class="form-label">Alamat *</label>
                <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $kurir->alamat ?? '') }}</textarea>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-3">
            <!-- Tombol Batal - Warna Sama Seperti Edit Karyawan -->
            <a href="{{ url('/mkurir') }}" class="btn btn-cancel">Batal</a>
            <button type="submit" class="btn btn-primary btn-save">Simpan Perubahan</button>
        </div>

    </form>
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

    password.addEventListener('input', function () {
        const val = password.value;
        rules.length.classList.toggle('valid', val.length >= 8);
        rules.upper.classList.toggle('valid', /[A-Z]/.test(val));
        rules.lower.classList.toggle('valid', /[a-z]/.test(val));
        rules.number.classList.toggle('valid', /[0-9]/.test(val));
        rules.symbol.classList.toggle('valid', /[@$!%*?&#]/.test(val));
    });
</script>

<!-- Tombol Kembali -->
<a href="javascript:history.back()" class="btn-back" title="Kembali">
    <i class="bi bi-arrow-left"></i>
</a>

</body>
</html>