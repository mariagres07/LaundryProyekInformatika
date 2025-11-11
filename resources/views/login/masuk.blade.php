<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk - Iva Laundry</title>

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

    .login-wrapper {
      width: 85%;
      max-width: 600px;
      background: rgba(255, 255, 255, 0.92);
      border-radius: 25px;
      padding: 50px 40px;
      box-shadow: 0 15px 35px rgba(0, 0, 0, 0.25);
      text-align: center;
    }

    h2 {
      color: #7bbde8;
      font-size: 36px;
      font-weight: 600;
      margin-bottom: 15px;
    }

    p {
      color: #555;
      font-size: 18px;
      margin-bottom: 30px;
    }

    .form-group {
      margin-bottom: 20px;
      text-align: left;
    }

    label {
      font-weight: 600;
      color: #333;
      margin-bottom: 8px;
      display: block;
      font-size: 18px;
    }

    /* ✅ Menyamakan style untuk semua input */
    input[type="text"],
    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 14px 15px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 18px;
      transition: all 0.3s ease;
      background-color: #fff;
    }

    /* Efek saat fokus */
    input:focus {
      border-color: #7bbde8;
      box-shadow: 0 0 8px rgba(123, 189, 232, 0.4);
      outline: none;
    }

    /* Efek hover */
    input:hover {
      border-color: #9bcdf0;
    }

    .btn {
      width: 100%;
      padding: 15px;
      border: none;
      border-radius: 12px;
      background-color: #7bbde8;
      color: #fff;
      font-weight: 700;
      font-size: 20px;
      cursor: pointer;
      transition: background 0.3s;
      margin-top: 10px;
    }

    .btn:hover {
      background-color: #63aad5;
    }

    .login-link {
      margin-top: 20px;
      font-size: 18px;
      color: #333;
    }

    .login-link a {
      color: #7bbde8;
      font-weight: 600;
      text-decoration: none;
    }

    .alert-success,
    .alert-danger {
      padding: 12px;
      border-radius: 8px;
      margin-bottom: 20px;
      font-size: 16px;
      text-align: left;
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

    @media (max-width: 700px) {
      .login-wrapper {
        width: 95%;
        padding: 40px 30px;
      }

      h2 {
        font-size: 28px;
      }

      p,
      label,
      input,
      .btn,
      .login-link {
        font-size: 16px;
      }
    }
  </style>
</head>

<body>
  <div class="login-wrapper">
    <h2>Masuk</h2>
    <p>Silakan masuk dengan akun Iva Laundry Anda.</p>

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

    <form action="{{ route('login.process') }}" method="POST">
      @csrf

      <div class="form-group">
        <label for="email">Email</label>
        <input type="email" id="email" name="email" value="{{ old('email') }}" required>
      </div>

      <div class="form-group">
        <label for="password">Password</label>
        <input type="password" id="password" name="password" required>
      </div>

      <button type="submit" class="btn">Masuk</button>
    </form>

    <div class="login-link">
      Belum punya akun? <a href="{{ url('/daftar') }}">Daftar di sini</a>
    </div>
  </div>
</body>

</html>