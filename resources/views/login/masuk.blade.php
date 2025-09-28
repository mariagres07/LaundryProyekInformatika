<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Masuk - Iva Laundry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background: url('https://img.freepik.com/free-photo/abstract-background-water-texture_23-2148176921.jpg') no-repeat center center fixed;
      background-size: cover;
    }
    .login-box {
      max-width: 400px;
      margin: 100px auto;
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
    <div class="login-box">
      <h3 class="text-center text-primary mb-4">MASUK</h3>
      <form action="{{ url('/login') }}" method="POST">
        @csrf
        <div class="mb-3">
          <label for="username" class="form-label">Username <span class="text-danger">*</span></label>
          <input type="text" class="form-control" id="username" name="username" required>
        </div>
        <div class="mb-3">
          <label for="password" class="form-label">Password <span class="text-danger">*</span></label>
          <input type="password" class="form-control" id="password" name="password" required>
        </div>
        <button type="submit" class="btn btn-custom">MASUK</button>
      </form>
    </div>
  </div>
</body>
</html>
