<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Detail Verifikasi Pesanan - IVA Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            background-color: #f8f9fa;
            font-family: "Poppins", sans-serif;
        }

        .header-bg {
            background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
            padding: 2rem;
            color: #0d6efd;
            text-shadow: 1px 1px white;
            border-radius: 0 0 30px 30px;
        }

        .form-label {
            font-weight: 600;
            color: #2d4b74;
        }

        .btn-primary {
            background-color: #2d4b74;
            border: none;
        }

        .btn-primary:hover {
            background-color: #1e3658;
        }
    </style>
</head>

<body>

    @include('Dashboard.kurir_sidenav')

    <!-- Header -->
    <div class="header-bg mb-4">
        <h2 class="fw-bold">Verifikasi Pesanan {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</h2>
    </div>

    <div class="container mb-5">

        <!-- Alert jika sukses -->
        @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
        @endif

        <!-- Detail Pesanan -->
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">
                <div class="row mb-2">
                    <div class="col-md-4 form-label">Nama Pelanggan</div>
                    <div class="col-md-8">: {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Kategori Item</div>
                    <div class="col-md-8">:
                        @foreach($pesanan->detailTransaksi as $detail)
                        {{ $detail->kategoriItem->namaKategori ?? '-' }} :
                        {{ $detail->jumlahItem ?? '-' }} <br>
                        @endforeach
                    </div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Layanan / Pewangi</div>
                    <div class="col-md-8">: {{ $pesanan->layanan->namaLayanan ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Alamat</div>
                    <div class="col-md-8">: {{ $pesanan->pelanggan->alamat ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Nomor HP</div>
                    <div class="col-md-8">: {{ $pesanan->pelanggan->noHp ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Tanggal Masuk</div>
                    <div class="col-md-8">: {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y') }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Status Saat Ini</div>
                    <div class="col-md-8">
                        : <span class="badge bg-warning text-dark">{{ $pesanan->statusPesanan ?? 'Belum Diketahui' }}</span>
                    </div>
                </div>
            </div>
        </div>

        <!-- Form input berat -->
        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('verifikasi.perhitungan', $pesanan->idPesanan) }}" method="POST">
                    @csrf
                    <div class="row mb-3">
                        <div class="col-md-4 form-label">Berat Barang (kg)</div>
                        <div class="col-md-8">
                            <input type="number" step="0.1" class="form-control" name="beratBarang"
                                value="{{ old('beratBarang', $pesanan->beratBarang) }}"
                                placeholder="Masukkan berat cucian (kg)" required>
                        </div>
                    </div>

                    <div class="text-end">
                        <button type="submit" class="btn btn-primary px-4">Verifikasi Pesanan</button>
                    </div>
                </form>
            </div>
        </div>

        <!-- Tombol kembali -->
        <div class="mt-4">
            <a href="{{ route('lihatverifikasi.index') }}" class="btn btn-secondary">Kembali</a>
            <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>

    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>