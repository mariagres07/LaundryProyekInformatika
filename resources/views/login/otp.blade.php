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

    /* Div OTP di bawah layar */
    #otp-bottom {
      position: fixed;
      bottom: 20px;
      left: 50%;
      transform: translateX(-50%);
      background: #3f51b5;
      color: white;
      padding: 15px 25px;
      border-radius: 12px;
      font-weight: bold;
      z-index: 9999;
      font-size: 18px;
      box-shadow: 0 4px 15px rgba(0,0,0,0.2);
    }

  </style>
</head>
<body>
  <div class="card">
    <h4 class="title">KODE OTP</h4>
    <p class="text-danger">Masukkan kode OTP kamu di bawah ini</p>

    <form method="POST" action="{{ route('otp.verify') }}">
      @csrf
      <div class="d-flex justify-content-center">
        @for ($i = 0; $i < 6; $i++)
          <input type="text" maxlength="1" class="otp-input" name="otp[]" required>
        @endfor
      </div>
      <button type="submit" class="btn btn-primary mt-4">Verifikasi</button>
    </form>

    {{-- Timer OTP --}}
    @if(isset($expiresAt))
      <p id="timer" class="mt-3"></p>
      <script>
        const expiresAt = new Date("{{ $expiresAt }}").getTime();
        function updateTimer() {
          const now = new Date().getTime();
          const distance = expiresAt - now;
          const timerEl = document.getElementById("timer");

          if (distance <= 0) {
            timerEl.innerHTML = "Kode OTP telah kedaluwarsa!";
            return;
          }

          const seconds = Math.floor((distance % (1000 * 60)) / 1000);
          timerEl.innerHTML = "Kode OTP berlaku " + seconds + " detik lagi";
          setTimeout(updateTimer, 1000);
        }
        updateTimer();
      </script>
    @endif
  </div>

  {{-- Div OTP muncul di bawah layar --}}
  @if(isset($otp))
    <div id="otp-bottom">
      Kode OTP Kamu: {{ $otp }}
    </div>
  @endif

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
