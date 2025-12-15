<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Reset Password - Iva Laundry</title>

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
    }

    .left {
      flex: 1;
      padding: 50px;
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
      margin-bottom: 25px;
      font-size: 14px;
      text-align: center;
    }

    .form-group {
      margin-bottom: 15px;
      position: relative;
    }

    label {
      font-weight: 600;
      margin-bottom: 5px;
      color: #333;
      display: block;
    }

    input[type="email"],
    input[type="password"] {
      width: 100%;
      padding: 10px 12px;
      border: 1px solid #ccc;
      border-radius: 8px;
      font-size: 15px;
      transition: 0.3s;
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
    }

    .btn {
      width: 100%;
      padding: 12px;
      background: #7bbde8;
      color: white;
      border: none;
      border-radius: 10px;
      font-weight: 600;
      font-size: 16px;
      margin-top: 10px;
      cursor: pointer;
      transition: 0.3s;
    }

    .btn:hover {
      background: #63aad5;
    }

    .alert-danger {
      background: #fdeaea;
      color: #b42318;
      padding: 10px;
      margin-bottom: 15px;
      border-radius: 8px;
      border: 1px solid #f3b6b0;
      font-size: 14px;
    }

    .alert-danger ul {
      margin: 0;
      padding-left: 20px;
    }

    .right {
      flex: 1;
      background: linear-gradient(to bottom right, #7bbde8, #a4d4f2);
      display: flex;
      flex-direction: column;
      justify-content: center;
      align-items: center;
      color: #000;
      padding: 40px;
      text-align: center;
    }

    .right img {
      width: 150px;
      margin-bottom: 20px;
    }

    @media (max-width: 900px) {
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

      <h2>Atur Password Baru</h2>
      <p>Masukkan email dan password baru Anda untuk melanjutkan.</p>

      {{-- notifikasi error yang di atas email tadi --}}
      {{-- @if($errors->any())
      <div class="alert-danger">
        <ul>
          @foreach($errors->all() as $err)
          <li>{{ $err }}</li>
          @endforeach
        </ul>
      </div>
      @endif --}}

      <form action="{{ route('password.update') }}" method="POST">
        @csrf

        <div class="form-group">
          <label for="email">Email *</label>
          <input type="email" id="email" name="email" value="{{ old('email', request('email')) }}" required>
          @error('email')
          <small style="color:red; font-size:13px;">{{ $message }}</small>
          @enderror
        </div>

        <div class="form-group">
          <label for="password">Password Baru *</label>
          <input type="password" id="password" name="password" required>
          <i class="fa-solid password-toggle" onclick="togglePassword('password', this)"></i>
        </div>

        <div class="form-group">
          <label for="password_confirmation">Konfirmasi Password Baru *</label>
          <input type="password" id="password_confirmation" name="password_confirmation" required>
          <i class="fa-solid password-toggle" onclick="togglePassword('password_confirmation', this)"></i>
        </div>

        <button type="submit" class="btn">Reset Password</button>
      </form>

    </div>

    <div class="right">
      <img src="selimut.png" alt="Laundry Icon">
      <h3>Reset Password</h3>
      <p>Ganti password akun Anda dengan lebih mudah dan aman.</p>
    </div>
  </div>

  <script>
    function togglePassword(id, el) {
      const input = document.getElementById(id);
      if (input.type === "password") {
        input.type = "text";
        el.classList.replace("fa-eye", "fa-eye-slash");
      } else {
        input.type = "password";
        el.classList.replace("fa-eye-slash", "fa-eye");
      }
    }
  </script>

</body>
</html>
