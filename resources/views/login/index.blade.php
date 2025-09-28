<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Iva Laundry</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f8f9fa;
    }
    .hero-section {
      height: 100vh;
      display: flex;
      justify-content: center;
      align-items: center;
    }
    .hero-card {
      border: 3px solid #ccc;
      border-radius: 10px;
      padding: 30px;
      text-align: center;
      background: #fff;
    }
    .hero-title {
      font-size: 3rem;
      font-weight: bold;
      color: #4682B4;
    }
    .btn-custom {
      background: linear-gradient(to bottom, #a3c1d9, #7a9cb7);
      color: white;
      font-weight: bold;
      border-radius: 10px;
      padding: 10px 25px;
      margin: 5px;
    }
  </style>
</head>
<body>
  <div class="container hero-section">
    <div class="hero-card shadow">
      <h1 class="hero-title">Iva Laundry</h1>
      <p class="text-muted">Jl. Paingan 3 No 3</p>
      <div class="d-flex justify-content-center">
        <a href="{{ url('/masuk') }}" class="btn btn-custom">MASUK</a>
        <a href="{{ url('/daftar') }}" class="btn btn-custom">DAFTAR</a>
      </div>
    </div>
  </div>
</body>
</html>
