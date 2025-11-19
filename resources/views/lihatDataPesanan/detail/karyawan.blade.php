<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Pesanan - IVA Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        font-family: "Poppins", sans-serif;
        background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
        min-height: 100vh;
    }

    .container-custom {
        max-width: 700px;
        background: white;
        border-radius: 20px;
        padding: 30px;
        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
    }

    h2 {
        color: #2d4b74;
        font-weight: 700;
        margin-bottom: 25px;
        text-align: center;
    }

    .text-label {
        color: #2d4b74;
        font-weight: 600;
    }

    .btn-primary {
        background-color: #2d4b74;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e3a5c;
    }

    /* Tombol kembali di kiri bawah */
    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #8ab2d3ff;
        color: white;
        border: none;
        border-radius: 50%;
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.4rem;
        transition: 0.3s;
        cursor: pointer;
        box-shadow: 0 4px 10px rgba(0, 0, 0, 0.2);
    }
    </style>
</head>

<body class="bg-light">

    @include('Dashboard.kurir_sidenav')

    <div class="container my-5 container-custom">
        <h2>Verifikasi Pesanan</h2>

        @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
        @endif

        <div class="row mb-2">
            <div class="col-5 text-label">Nama Pelanggan</div>
            <div class="col-7">: {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-5 text-label">Alamat</div>
            <div class="col-7">: {{ $pesanan->pelanggan->alamat ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-5 text-label">No HP</div>
            <div class="col-7">: {{ $pesanan->pelanggan->noHp ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-5 text-label">Paket (Pewangi)</div>
            <div class="col-7">: {{ $pesanan->layanan->namaLayanan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-5 text-label">Kategori Item</div>
            <div class="col-7">:
                @foreach($pesanan->detailTransaksi as $detail)
                {{ $detail->kategoriItem->namaKategori ?? '-' }} - {{ $detail->jumlahItem ?? '-' }}<br>
                @endforeach
            </div>
        </div>

        <!-- Form Verifikasi -->
        <form action="{{ route('verifikasi.perhitungan', $pesanan->idPesanan) }}" method="POST" class="mt-3">
            @csrf
            <div class="mb-3">
                <label class="form-label text-label">Berat Barang (kg)</label>
                <input type="number" step="0.1" name="beratBarang"
                    value="{{ old('beratBarang', $pesanan->beratBarang) }}" class="form-control rounded-3"
                    placeholder="Masukkan berat (kg)" required>
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-check-circle me-1"></i> Verifikasi
                </button>
            </div>
        </form>
    </div>

    <!-- Tombol Kembali ke Dashboard -->
    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>

</html>