<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Detail Pesanan Laundry - IVA Laundry</title>

    <!-- Bootstrap & Icons -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;500;600&display=swap" rel="stylesheet">

    <style>
    * {
        font-family: "Poppins", sans-serif;
        box-sizing: border-box;
    }

    body {
        background-color: #eaf6ff;
        margin: 0;
        padding: 0;
    }

    /* ==== HEADER ==== */
    .header-wrapper {
        position: relative;
        width: 100%;
        height: 200px;
        overflow: hidden;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
    }

    .header-bg {
        background: linear-gradient(to right, #007bff35, #5dade26d), url('/water.jpg');
        background-size: cover;
        background-position: center;
        width: 100%;
        height: 100%;
        filter: brightness(0.8);
    }

    .header-content {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-align: center;
        font-weight: bold;
        font-size: 32px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
    }

    /* ==== MAIN ==== */
    .main-container {
        width: 90%;
        max-width: 1000px;
        margin: 60px auto;
        padding: 40px;
        background: rgba(255, 255, 255, 0.96);
        border-radius: 20px;
        box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
    }

    /* Card ringkasan pesanan */
    .card {
        width: 100%;
        background: rgba(255, 255, 255, 0.92);
        border-radius: 20px;
        box-shadow: 0px 10px 30px rgba(0, 0, 0, 0.15);
        overflow: hidden;
    }

    .card-header.bg-primary.text-white {
        background: linear-gradient(135deg, #6fa8dc, #3d85c6);
        color: #fff;
        font-weight: 600;
        font-size: 1.3rem;
        letter-spacing: 0.5px;
        border-top-left-radius: 16px;
        border-top-right-radius: 16px;
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.15);
        display: flex;
        align-items: center;
        gap: 10px;
        padding: 15px 20px;
        justify-content: center;
    }

    .card-body {
        font-size: 1.1rem;
        padding: 30px 40px;
    }

    .list-group-item {
        font-size: 1.05rem;
        padding: 15px 20px;
    }

    .list-group-item strong {
        display: block;
        margin-bottom: 8px;
    }

    /* Tombol kembali (tetap ada tapi dihilangkan jika tidak ingin) */
    .btn-back {
        position: fixed;
        bottom: 25px;
        left: 25px;
        background-color: #8ab2d3;
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
        box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }

    .btn-back:hover {
        background-color: #0056b3;
        transform: scale(1.1);
    }

    @media (max-width: 768px) {
        .main-container {
            width: 95%;
            padding: 25px;
        }

        .card-body {
            padding: 20px;
        }

        .header-content {
            font-size: 24px;
        }
    }
    </style>
</head>

<body>

    @include('Dashboard.pelanggan_sidenav')

    <!-- ==== HEADER ==== -->
    <div class="header-wrapper">
        <div class="header-bg"></div>
        <div class="header-content">
            <h1>Detail Pesanan Laundry</h1>
        </div>
    </div>

    <!-- ==== MAIN CONTENT ==== -->
    <div class="main-container">
        @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
        @endif

        {{-- CARD RINGKASAN PESANAN AWAL --}}
        <div class="card mb-4 shadow-sm">
            <div class="card-header bg-primary text-white">
                <i class="bi bi-receipt"></i> Ringkasan Pesanan
            </div>
            <div class="card-body">

                <ul class="list-group list-group-flush">
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Nama Pelanggan</span>
                        <span>{{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Alamat</span>
                        <span>{{ $pesanan->alamat ?? '-' }}</span>
                    </li>

                    <li class="list-group-item">
                        <strong>Kategori Laundry:</strong>
                        <ul class="mt-2 mb-0">
                            @php
                            $kategori = ['pakaian', 'seprai', 'handuk'];
                            @endphp
                            @foreach($kategori as $kat)
                            <li>{{ ucfirst($kat) }}: {{ $pesanan->{$kat} ?? 0 }}</li>
                            @endforeach
                        </ul>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Jenis Paket</span>
                        <span>{{ $pesanan->paket ?? '-' }}</span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Estimasi Hari</span>
                        @php
                        $hari = str_contains(strtolower($pesanan->paket ?? ''), 'express') ? 1 : 3;
                        @endphp
                        <span>{{ $hari }} Hari</span>
                    </li>

                   {{-- === MODIFIKASI BERAT DAN HARGA (KONDISIONAL) === --}}
                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Berat Barang</span>
                        <span>
                            @if (!is_null($pesanan->beratBarang))
                                **{{ $pesanan->beratBarang }} kg**
                            @else
                                <span class="badge bg-secondary">Menunggu Verifikasi</span>
                            @endif
                        </span>
                    </li>

                    <li class="list-group-item d-flex justify-content-between align-items-center">
                        <span>Total Harga (Estimasi/Final)</span>
                        <span>
                            @if (!is_null($pesanan->totalHarga) && !is_null($pesanan->beratBarang))
                                **Rp {{ number_format($pesanan->totalHarga, 0, ',', '.') }}**
                            @else
                                <span class="badge bg-secondary">Menunggu Verifikasi</span>
                            @endif
                        </span>
                    </li>
                    {{-- === END MODIFIKASI BERAT DAN HARGA (KONDISIONAL) === --}}                    
                </ul>
            </div>
        </div>
        {{-- END CARD RINGKASAN PESANAN AWAL --}}

       {{-- === CARD STATUS VERIFIKASI & AKSI PEMBAYARAN === --}}
<div class="card mb-4 shadow-sm">
    <div class="card-header bg-success text-white">
        <i class="bi bi-info-circle"></i> Status Verifikasi & Tagihan
    </div>

    <div class="card-body">

        {{-- ===========================
            BELUM DIVERIFIKASI
        ============================ --}}
        @if ($pesanan->statusPesanan === 'Menunggu Pembayaran')
            <div class="alert alert-warning text-center">
                <h5 class="alert-heading fw-bold">
                    <i class="bi bi-exclamation-triangle-fill"></i>
                    Menunggu Verifikasi Kurir
                </h5>
                <p class="mb-0">Kurir belum menimbang barang Anda.</p>
            </div>

            <button class="btn btn-secondary w-100 mt-3" disabled>
                <i class="bi bi-clock-history"></i> Pembayaran Belum Tersedia
            </button>


        {{-- ===========================
            SUDAH DIVERIFIKASI, SIAP BAYAR
        ============================ --}}
        @elseif ($pesanan->statusPesanan === 'Menunggu Pembayaran')
            <div class="alert alert-info text-center">
                <strong>Verifikasi selesai!</strong> Total harga sudah dihitung.
            </div>

            <a href="{{ route('pembayaran.index', $pesanan->idPesanan) }}"
               class="btn btn-primary w-100 mt-3 fs-5 py-2">
                <i class="bi bi-credit-card"></i> BAYAR SEKARANG
            </a>


        {{-- ===========================
            SUDAH LUNAS
        ============================ --}}
        @elseif ($pesanan->statusPesanan === 'Sudah Dibayar') 
            <div class="alert alert-success text-center">
                <strong>Pembayaran Lunas</strong>
            </div>

            <button class="btn btn-success w-100 mt-3" disabled>
                <i class="bi bi-check-circle"></i> Pembayaran Sudah Lunas
            </button>

        @else
            {{-- ANTISIPASI STATUS TAK DIKENAL --}}
            <div class="alert alert-secondary text-center">
                Status pesanan: {{ $pesanan->statusPesanan }}
            </div>
        @endif

    </div>
</div>
{{-- === END CARD STATUS VERIFIKASI & AKSI PEMBAYARAN === --}}


    <a href="javascript:history.back()" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="{{ asset('js/dashboard.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>