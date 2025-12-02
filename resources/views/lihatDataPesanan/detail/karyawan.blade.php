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
        max-width: 800px;
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

    .data-value {
        color: #495057;
    }

    .status-badge {
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 0.9rem;
        font-weight: 600;
        text-transform: uppercase;
        display: inline-block;
    }

    .status-menunggu-penjemputan {
        background-color: #fff3cd;
        color: #856404;
        border: 1px solid #ffeaa7;
    }

    .status-menunggu-pembayaran {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .status-diproses,
    .status-sedang-diproses {
        background-color: #d1ecf1;
        color: #0c5460;
        border: 1px solid #bee5eb;
    }

    .status-menunggu-pengantaran {
        background-color: #cce7ff;
        color: #004085;
        border: 1px solid #b3d7ff;
    }

    .status-sudah-diantar {
        background-color: #d4edda;
        color: #155724;
        border: 1px solid #c3e6cb;
    }

    .status-selesai {
        background-color: #28a745;
        color: white;
        border: 1px solid #218838;
    }

    .status-dibatalkan {
        background-color: #f8d7da;
        color: #721c24;
        border: 1px solid #f5c6cb;
    }

    .btn-primary {
        background-color: #2d4b74;
        border: none;
    }

    .btn-primary:hover {
        background-color: #1e3a5c;
    }

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
        text-decoration: none;
    }
    </style>
</head>

<body class="bg-light">

    @include('Dashboard.karyawan_sidenav')

    <div class="container my-5 container-custom">

        <h2>Detail Pesanan {{ $pesanan->no_pesanan ?? $pesanan->idPesanan }}</h2>

        @if(session('success'))
        <div class="alert alert-success rounded-3">{{ session('success') }}</div>
        @endif

        <div class="row mb-3 pb-2 border-bottom">
            <div class="col-sm-5 text-label">Status Pesanan</div>
            <div class="col-sm-7 data-value">

                @php
                $status_text = $pesanan->statusPesanan ?? 'Tidak diketahui';
                $status_class = strtolower(str_replace(' ', '-', $status_text));
                @endphp

                <span class="status-badge status-{{ $status_class }}">
                    {{ $status_text }}
                </span>

            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-5 text-label">Tanggal</div>
            <div class="col-sm-7 data-value">
                : {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y') }}
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-5 text-label">Nama Pelanggan</div>
            <div class="col-sm-7 data-value">: {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-5 text-label">No HP</div>
            <div class="col-sm-7 data-value">: {{ $pesanan->pelanggan->noHp ?? '-' }}</div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-5 text-label">Alamat</div>
            <div class="col-sm-7 data-value">: {{ $pesanan->pelanggan->alamat ?? '-' }}</div>
        </div>

        <hr class="my-4">

        <div class="row mb-2">
            <div class="col-sm-5 text-label">Paket Layanan</div>
            <div class="col-sm-7 data-value">
                : {{ $pesanan->layanan->namaLayanan ?? '-' }}
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-5 text-label">Kategori Item</div>
            <div class="col-sm-7 data-value">
                :
                @php
                $items = [];

                if ($pesanan->pakaian > 0) {
                $items[] = "Pakaian ({$pesanan->pakaian} pcs)";
                }

                if ($pesanan->handuk > 0) {
                $items[] = "Handuk ({$pesanan->handuk} pcs)";
                }

                if ($pesanan->seprai > 0) {
                $items[] = "Seprai/Handuk/Bed Cover ({$pesanan->seprai} pcs)";
                }

                echo !empty($items) ? implode(', ', $items) : '-';
                @endphp
            </div>
        </div>


        <div class="row mb-2">
            <div class="col-sm-5 text-label">Berat Barang (kg)</div>
            <div class="col-sm-7 data-value">: {{ $pesanan->beratBarang ?? 'Belum terverifikasi' }} 
            </div>
        </div>

        <div class="row mb-2">
            <div class="col-sm-5 text-label">Total Pembayaran</div>
            <div class="col-sm-7 data-value">
                : Rp {{ number_format($pesanan->totalHarga ?? 0, 0, ',', '.') }}
            </div>
        </div>

        <hr class="my-4">

        <h4 class="mb-3 text-label"><i class="bi bi-pencil-square me-2"></i>Perbarui Status Pesanan</h4>

        <form action="{{ route('update.status', $pesanan->idPesanan) }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="statusPesanan" class="form-label text-label">Pilih Status Baru</label>
                <select name="statusPesanan" id="statusPesanan" class="form-select rounded-3" required>
                    <option value="">-- Pilih Status --</option>
                    {{-- <option value="Menunggu Penjemputan" @selected($pesanan->statusPesanan=='MenungguPenjemputan')>Menunggu Penjemputan</option> --}}
                    {{-- <option value="Menunggu Pembayaran" @selected($pesanan->statusPesanan=='Menunggu Pembayaran')>Menunggu Pembayaran</option> --}}
                    <option value="Diproses" @selected($pesanan->statusPesanan=='Diproses')>Diproses</option>
                    <option value="Menunggu Pengantaran" @selected($pesanan->statusPesanan=='MenungguPengantaran')>Menunggu Pengantaran</option>
                    {{-- <option value="Sudah Diantar" @selected($pesanan->statusPesanan=='Sudah Diantar')>Sudah Diantar</option> --}}
                    <option value="Selesai" @selected($pesanan->statusPesanan=='Selesai')>Selesai</option>
                    <option value="Dibatalkan" @selected($pesanan->statusPesanan=='Dibatalkan')>Dibatalkan</option>
                </select>

                @error('statusPesanan')
                <div class="text-danger mt-1">{{ $message }}</div>
                @enderror
            </div>

            <div class="text-end">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-arrow-repeat me-1"></i> Update Status
                </button>
            </div>
        </form>

    </div>

    <a href="{{ route('lihatdata.index') }}" class="btn-back" title="Kembali ke Daftar Pesanan">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>

</html>