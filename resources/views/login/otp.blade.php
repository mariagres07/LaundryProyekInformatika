<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kode OTP</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    body {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
      background: url('https://i.ibb.co/vPbfmW2/water-bg.jpg') no-repeat center center;
      background-size: cover;
    }
    .card {
      border-radius: 20px;
      padding: 40px;
      text-align: center;
      background-color: white;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }
    .otp-input {
      width: 50px;
      height: 50px;
      margin: 5px;
      text-align: center;
      font-size: 24px;
      border: 2px solid #00aaff;
      border-radius: 8px;
      outline: none;
    }
    .otp-input:focus {
      border-color: #7d3cff;
      box-shadow: 0 0 5px rgba(125, 60, 255, 0.6);
    }
    .title {
      color: #3f51b5;
      font-weight: bold;
      margin-bottom: 10px;
    }
    .text-danger {
      font-size: 14px;
    }
  </style>
</head>
<body>
  <div class="card">
    <h4 class="title">KODE OTP</h4>
    <p class="text-danger">Masukkan kode otp yang dikirim ke email</p>

    <form method="POST" action="/verifikasi-otp">
      @csrf
      <div class="d-flex justify-content-center">
        <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
        <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
        <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
        <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
        <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
        <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
      </div>
      <button type="submit" class="btn btn-primary mt-4">Verifikasi</button>
    </form>
  </div>

  <script>
    // Auto pindah ke kotak berikutnya
    const inputs = document.querySelectorAll('.otp-input');
    inputs.forEach((input, index) => {
      input.addEventListener('input', () => {
        if (input.value.length === 1 && index < inputs.length - 1) {
          inputs[index + 1].focus();
        }
      });
    });
  </script>
</body>
</html>
