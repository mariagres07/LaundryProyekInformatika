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
    background-image: url('{{ asset("water.jpg") }}');
    background-size: cover;
    background-position: center;
    background-repeat: no-repeat;
    padding: 3rem 2rem;
    border-radius: 0 0 30px 30px;
    color: white;
    font-weight: 700;
    font-size: 2.2rem;
    text-shadow: 2px 2px 4px rgba(0,0,0,0.4);
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

        /* Tombol kembali */
        .btn-kembali {
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

        .btn-kembali:hover {
            background-color: #7aa5c5;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.3);
        }

        .btn-kembali i {
            font-size: 1.2rem;
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

        @if(session('success'))
        <div class="alert alert-success rounded-4">{{ session('success') }}</div>
        @endif
        @if(session('error'))
        <div class="alert alert-danger rounded-4">{{ session('error') }}</div>
        @endif
        @if($errors->any())
        <div class="alert alert-danger rounded-4">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif
        <div class="card shadow-sm border-0 mb-4">
            <div class="card-body">

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Nama Pelanggan</div>
                    <div class="col-md-8">: {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</div>
                </div>

                <div class="row mb-2">
                    <div class="col-md-4 form-label">Kategori Item</div>
                    <div class="col-md-8">:
                        @php
                        $kategori = [
                            // 'Paket' => $pesanan->paket,
                            'Pakaian' => $pesanan->pakaian,
                            'Seprai/Seprai/Bed Cover' => $pesanan->seprai,
                            'Handuk' => $pesanan->handuk,
                        ];
                        @endphp

                        @foreach($kategori as $nama => $jumlah)
                            @if($jumlah !== null && $jumlah > 0)
                                {{ $nama }} : {{ $jumlah }} <br>
                            @endif
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
                        : 
                         {{-- Logika badge --}}
                        @php
                            $badgeClass = match($pesanan->statusPesanan) {
                                'Menunggu Penjemputan' => 'bg-info',
                                'Menunggu Pembayaran' => 'bg-warning text-dark',
                                default => 'bg-secondary'
                            };
                        @endphp
                        <span class="badge bg-warning text-dark">{{ $pesanan->statusPesanan ?? 'Belum Diketahui' }}</span>
                    </div>
                </div>

                 @if ($pesanan->beratBarang)
                <div class="row mb-2 border-top pt-3 mt-3">
                    <div class="col-md-4 form-label">Berat Terverifikasi</div>
                    <div class="col-md-8">: <span class="fw-bold text-success">{{ $pesanan->beratBarang }} kg</span></div>
                </div>
                <div class="row mb-2">
                    <div class="col-md-4 form-label">Total Harga</div>
                    <div class="col-md-8">: <span class="fw-bold text-success">Rp {{ number_format($pesanan->totalHarga, 0, ',', '.') }}</span></div>
                </div>
                @endif

            </div>
        </div>

        <div class="card shadow-sm border-0">
            <div class="card-body">
                <form action="{{ route('verifikasi.perhitungan', $pesanan->idPesanan) }}" method="POST">
                    @csrf

                    <div class="row mb-3">
                        <div class="col-md-4 form-label">Berat Barang (kg)</div>
                        <div class="col-md-8">
                            <input type="number" step="0.1" class="form-control"
                                name="beratBarang"
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
    </div>

    <!-- Tombol Kembali -->
    <a href="{{ route('lihatverifikasi.index') }}" class="btn-kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
