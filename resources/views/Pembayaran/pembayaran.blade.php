<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pembayaran | IVA Laundry</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Poppins', sans-serif;
        }

        .payment-card {
            max-width: 550px;
            margin: 60px auto;
            border: 1px solid #ccc;
            border-radius: 12px;
            background: #fff;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.08);
            padding: 25px;
        }

        .copy-btn {
            background-color: #0b3d91;
            color: white;
            border: none;
            border-radius: 10px;
            padding: 10px;
            font-weight: 600;
        }

        .copy-btn:hover {
            background-color: #062b68;
        }

        .payment-code {
            font-size: 20px;
            font-weight: bold;
            background-color: #0b3d91;
            color: #fff;
            border-radius: 10px;
            padding: 10px;
            text-align: center;
            margin-bottom: 10px;
        }

        .date-text {
            color: #e74c3c;
            font-size: 0.9rem;
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="payment-card">

        <div id="notifBox"></div>

        {{-- Notifikasi sukses --}}
        @if (session('success'))
        <div class="alert alert-success mt-3" role="alert">
            <i class="bi bi-check-circle"></i> {{ session('success') }}
        </div>
        @endif

        <div class="d-flex justify-content-between">
            <h4 class="fw-bold text-primary">Pembayaran</h4>
            <div class="date-text">{{ \Carbon\Carbon::now()->format('d/m/Y') }}</div>
        </div>

        <p>Lakukan pembayaran dengan menyalin kode pembayaran berikut:</p>

        <div class="row align-items-center">
            <div class="col-md-6">
                <div class="payment-code" id="kodePembayaran">
                    {{ $kodePembayaran ?? '-' }}
                </div>
                <button class="copy-btn w-100" onclick="salinKode()">
                    <i class="bi bi-clipboard"></i> SALIN KODE
                </button>
            </div>
        </div>

        <hr>

        <div class="mt-3">
            <p><strong>Layanan:</strong> {{ $layanan->namaLayanan }}</p>
            <p><strong>Berat Barang:</strong> {{ $pesanan->beratBarang }} kg</p>
            <p><strong>Total Harga:</strong> Rp {{ number_format($pesanan->totalHarga, 0, ',', '.') }}</p>
        </div>

        <form action="{{ route('pembayaran.proses', ['idPesanan' => $pesanan->idPesanan]) }}" method="POST"
            enctype="multipart/form-data">
            @csrf

            @error('buktiPembayaran')
            <div class="alert alert-danger mt-2">{{ $message }}</div>
            @enderror

            <div class="mb-3">
                <label for="buktiPembayaran" class="form-label fw-semibold">Upload Bukti Pembayaran</label>
                <input type="file" name="buktiPembayaran" id="buktiPembayaran" class="form-control">
            </div>

            <button type="submit" class="btn btn-success w-100 mt-2">
                <i class="bi bi-upload"></i> Konfirmasi Pembayaran
            </button>
        </form>

        <div class="text-center mt-4">
            <a href="{{ route('lihatdata.detail', $pesanan->idPesanan) }}" class="btn btn-outline-secondary"> Kembali
            </a>
        </div>

    </div>

    <script>
        function salinKode() {
            let kode = document.getElementById("kodePembayaran").innerText;
            navigator.clipboard.writeText(kode);
            alert("Kode pembayaran berhasil disalin: " + kode);
        }
    </script>

</body>

</html>