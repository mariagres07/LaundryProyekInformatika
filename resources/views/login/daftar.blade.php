<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar - Iva Laundry</title>

  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Lora', serif;
    }

    body {
      background: url('water.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      min-height: 100vh;
    }

    .wrapper {
      display: flex;
      width: 85%;
      max-width: 1100px;
      background: rgba(255, 255, 255, 0.9);
      border-radius: 25px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
      overflow: hidden;
      margin: 30px auto;
    }

    .left {
      flex: 1;
      padding: 50px;
      display: flex;
      flex-direction: column;
      justify-content: center;
    }

    .left h2 {
      color: #7bbde8;
      font-size: 30px;
      font-weight: 600;
      margin-bottom: 10px;
      text-align: center;
    }

    .left p {
      color: #555;
      margin-bottom: 30px;
      font-size: 14px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
      position: relative;
    }

    label {
      display: block;
      font-weight: 600;
      color: #333;
      margin-bottom: 5px;
    }

    input[type="text"],
    input[type="email"],
    input[type="password"],
    input[type="tel"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: border-color 0.3s;
    }

    input:focus {
      border-color: #7bbde8;
      outline: none;
    }

    .password-toggle {
      position: absolute;
      right: 12px;
      top: 38px;
      cursor: pointer;
      color: #888;
      font-size: 16px;
    }

    .btn {
      width: 100%;
      padding: 12px;
      border: none;
      border-radius: 10px;
      background-color: #7bbde8;
      color: #fff;
      font-weight: 600;
      font-size: 16px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #63aad5;
    }

    .login-link {
      text-align: center;
      margin-top: 15px;
      color: #333;
      font-size: 15px;
    }

    .login-link a {
      color: #7bbde8;
      text-decoration: none;
      font-weight: 600;
    }

    .right {
      flex: 1;
      background: linear-gradient(to bottom right, #7bbde8, #a4d4f2);
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: #000;
      padding: 40px;
      text-align: center;
    }

    .right img {
      width: 150px;
      margin-bottom: 25px;
    }

    .right h3 {
      font-size: 24px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .right p {
      font-size: 15px;
      opacity: 0.9;
      max-width: 300px;
    }

    .alert-success,
    .alert-danger {
      padding: 10px;
      border-radius: 8px;
      margin-bottom: 15px;
      font-size: 14px;
    }

    .alert-success {
      background: #e6f9ed;
      color: #256d3b;
      border: 1px solid #a7e6b5;
    }

    .alert-danger {
      background: #fdeaea;
      color: #b42318;
      border: 1px solid #f3b6b0;
    }

    .alert-danger ul {
      list-style: none;
      padding-left: 0;
      margin: 0;
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

    @media (max-width: 900px) {
      .wrapper {
        flex-direction: column;
        width: 95%;
      }

      .right {
        display: none;
      }

      .left {
        padding: 35px;
      }
    }
  </style>

</head>

<body>
  <div class="wrapper">
    <div class="left">
      <h2>Daftar Akun</h2>
      <p>Buat akun baru untuk menikmati layanan laundry Iva dengan mudah.</p>

      @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
      @endif

      @if($errors->any())
      <div class="alert-danger">
        <ul>
          @foreach($errors->all() as $err)
          <li>{{ str_replace('The name field is required.', 'Nama lengkap wajib diisi.', $err) }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('register.process') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Nama Lengkap *</label>
          <input type="text" id="name" name="namaPelanggan" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="username">Username *</label>
          <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>

        <div class="form-group">
          <label for="name">Alamat *</label>
          <input type="text" id="name" name="alamat" value="{{ old('alamat') }}" required>
        </div>

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
          <label for="no_hp">No. HP *</label>
          <input type="tel" id="noHp" name="noHp" value="{{ old('noHp') }}" required>
        </div>

        <ul id="password-rules">
          <li id="rule-length">Minimal 8 karakter</li>
          <li id="rule-upper">Mengandung huruf besar (A-Z)</li>
          <li id="rule-lower">Mengandung huruf kecil (a-z)</li>
          <li id="rule-number">Mengandung angka (0-9)</li>
          <li id="rule-symbol">Mengandung simbol (@$!%*?&#)</li>
        </ul>

        <div class="form-group">
          <label for="password">Password *</label>
          <input type="password" id="password" name="password" required>
          <i class="fa-solid fa-eye password-toggle" id="toggle-main" onclick="togglePasswordAll(this)"></i>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Konfirmasi Password *</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required>
          <i class="fa-solid fa-eye password-toggle" id="toggle-mirror"></i>
        </div>

        <button type="submit" class="btn">Daftar</button>
      </form>

      <div class="login-link">
        Sudah punya akun? <a href="{{ url('/masuk') }}">Masuk di sini</a>
      </div>
    </div>

    <div class="right">
      <img src="selimut.png" alt="Laundry Icon">
      <h3>Selamat Datang di Iva Laundry</h3>
      <p>Atur dan pantau cucianmu dengan mudah lewat akun Iva Laundry — cepat, aman, dan terintegrasi.</p>
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

    function togglePasswordAll(el) {
      const fields = [
        document.getElementById('password'),
        document.getElementById('password_confirmation')
      ];

      const mirror = document.getElementById('toggle-mirror');

      const isHidden = fields[0].type === "password";

      fields.forEach(input => {
        input.type = isHidden ? "text" : "password";
      });

      el.classList.toggle("fa-eye-slash", isHidden);
      el.classList.toggle("fa-eye", !isHidden);

      mirror.classList.toggle("fa-eye-slash", isHidden);
      mirror.classList.toggle("fa-eye", !isHidden);
    }
  </script>
</body>

</html>