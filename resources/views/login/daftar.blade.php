<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar - Iva Laundry</title>

  <!-- FONT LORA -->
  <link href="https://fonts.googleapis.com/css2?family=Lora:wght@400;600&display=swap" rel="stylesheet">

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Lora', serif;
    }

    body {
      font-family: 'Lora', serif;
      background: url('water.jpg') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      margin: 0;
      padding: 0;
    }

    .wrapper {
      display: flex;
      width: 800px;
      background: rgba(255, 255, 255, 0.92);
      border-radius: 20px;
      box-shadow: 0 10px 25px rgba(0, 0, 0, 0.2);
      overflow: hidden;
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
      font-size: 28px;
      font-weight: 600;
      margin-bottom: 10px;
      text-align: center;
    }

    .left p {
      color: #555;
      margin-bottom: 30px;
      font-size: 13px;
      text-align: center;
      letter-spacing: 0.3px;
    }

    .form-group {
      margin-bottom: 15px;
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
      background-color: #7bbde8;
      display: flex;
      align-items: center;
      justify-content: center;
      flex-direction: column;
      color: #000000;
      padding: 40px;
      text-align: center;
    }

    .right img {
      width: 120px;
      margin-bottom: 25px;
    }

    .right h3 {
      font-size: 22px;
      font-weight: 600;
      margin-bottom: 10px;
    }

    .right p {
      font-size: 15px;
      opacity: 0.9;
      max-width: 280px;
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

    @media (max-width: 850px) {
      .wrapper {
        flex-direction: column;
        width: 95%;
      }

      .right {
        display: none;
      }
    }
  </style>
</head>

<body>

  <div class="wrapper">
    <div class="left">
      <h2>Daftar Akun</h2>
      <p>Buat akun baru untuk menikmati layanan laundry Iva dengan mudah.</p>

      {{-- Pesan sukses --}}
      @if(session('success'))
      <div class="alert-success">{{ session('success') }}</div>
      @endif

      {{-- Pesan error --}}
      @if($errors->any())
      <div class="alert-danger">
        <ul>
          @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
      @endif

      <form action="{{ route('register.process') }}" method="POST">
        @csrf
        <div class="form-group">
          <label for="name">Nama Lengkap</label>
          <input type="text" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="form-group">
          <label for="username">Username</label>
          <input type="text" id="username" name="username" value="{{ old('username') }}" required>
        </div>

        <!-- Tambahan: Nomor HP -->
        <div class="form-group">
          <label for="phone">Nomor HP</label>
          <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" pattern="[0-9]{10,13}" placeholder="contoh: 081234567890" required>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" required>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Konfirmasi Password</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required>
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

</body>

</html>