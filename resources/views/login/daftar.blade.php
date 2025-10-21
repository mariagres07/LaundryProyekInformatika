<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Daftar - Iva Laundry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('water.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .register-box {
      max-width: 450px;
      margin: 80px auto;
      padding: 30px;
      border-radius: 15px;
      background: rgba(255, 255, 255, 0.9);
      box-shadow: 0 4px 20px rgba(0,0,0,0.1);
    }
    .btn-custom {
      background: linear-gradient(to bottom, #a3c1d9, #7a9cb7);
      color: white;
      font-weight: bold;
      border-radius: 10px;
      padding: 10px;
      width: 100%;
    }
  </style>
</head>
<body>
  <div class="container">
    <div class="register-box">
      <h3 class="text-center text-primary mb-4">DAFTAR</h3>

      {{-- tampilkan success message --}}
      @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
      @endif

      {{-- tampilkan error umum --}}
      @if($errors->any())
        <div class="alert alert-danger">
          <ul class="mb-0">
            @foreach($errors->all() as $err)
              <li>{{ $err }}</li>
            @endforeach
          </ul>
        </div>
      @endif

      <form action="{{ route('register.process') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="name" class="form-label">Nama Lengkap <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" required>
        </div>

        <div class="mb-3">
          <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="username" name="username" value="{{ old('username') }}" required>
        </div>

        <div class="mb-3">
          <label for="email" class="form-label">Email <span class="text-danger">*</span></label>
          <input type="email" class="form-control" id="email" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>

        <div class="mb-3">
          <label for="password_confirmation" class="form-label">Konfirmasi Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-custom">DAFTAR</button>
      </form>

      <p class="text-center mt-3">Sudah punya akun? 
        <a href="{{ url('/masuk') }}" class="text-decoration-none">Masuk</a>
      </p>
    </div>
  </div>
</body>
</html>
