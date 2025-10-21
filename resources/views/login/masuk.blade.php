<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk - Iva Laundry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

  <style>
    body {
      background: url('water.jpg') no-repeat center center fixed;
      background-size: cover;
      font-family: 'Poppins', sans-serif;
    }

    .login-box {
      max-width: 400px;
      margin: 100px auto;
      padding: 40px 35px;
      border-radius: 25px;
      background: rgba(255, 255, 255, 0.92);
      box-shadow: 0 4px 25px rgba(0, 0, 0, 0.15);
      border: 3px solid #b3cce6;
    }

    h3 {
      color: #4a76a8;
      font-weight: 600;
      letter-spacing: 1px;
    }

    label {
      font-weight: 500;
      color: #1a3c6e;
    }

    label span {
      color: red;
      font-weight: bold;
    }

    .form-control {
      border: none;
      border-bottom: 2px solid #90caf9;
      border-radius: 0;
      background: transparent;
      box-shadow: none;
      font-size: 15px;
    }

    .form-control:focus {
      border-bottom: 2px solid #1e88e5;
      outline: none;
      box-shadow: none;
      background: transparent;
    }

    .btn-custom {
      background: linear-gradient(to bottom, #a3c1d9, #7a9cb7);
      color: white;
      font-weight: bold;
      border-radius: 10px;
      padding: 10px;
      width: 100%;
      border: none;
      transition: all 0.3s ease;
    }

    .btn-custom:hover {
      background: linear-gradient(to bottom, #7a9cb7, #5f88a2);
    }

    .alert {
      font-size: 14px;
      padding: 10px;
    }
  </style>
</head>
<body>

  <div class="container">
    <div class="login-box">
      <h3 class="text-center mb-4">MASUK</h3>

      {{-- 🔹 Pesan error --}}
      @if ($errors->any())
        <div class="alert alert-danger">
          @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
          @endforeach
        </div>
      @endif

      {{-- 🔹 Pesan sukses --}}
      @if (session('success'))
        <div class="alert alert-success">
          {{ session('success') }}
        </div>
      @endif

      <form action="{{ route('login.process') }}" method="POST">
        @csrf
        <div class="mb-4">
          <label for="email" class="form-label">Email <span>*</span></label>
          <input type="email" class="form-control" id="email" name="email" required>
        </div>

        <div class="mb-4">
          <label for="password" class="form-label">Password <span>*</span></label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <button type="submit" class="btn btn-custom">MASUK</button>
      </form>
    </div>
  </div>

</body>
</html>
