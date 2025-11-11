<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Kelola Pesanan - IVA Laundry</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Poppins', sans-serif;
            background: linear-gradient(to bottom, #f9f9f9 0%, #e7eef7 100%);
            min-height: 100vh;
        }

        .header-bg {
            background: url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;
            border-radius: 15px;
            padding: 25px 20px;
            margin: 15px;
            color: white;
            position: relative;
        }

        .header-bg::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: rgba(0, 0, 0, 0.4);
            border-radius: 15px;
        }

        .header-content {
            position: relative;
            z-index: 1;
        }

        .info-card {
            background: white;
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            border-left: 5px solid #28a745;
        }

        .action-card {
            background: linear-gradient(135deg, #e3f2fd 0%, #bbdefb 100%);
            border-radius: 15px;
            padding: 20px;
            margin: 15px;
            border: 2px solid #2196f3;
        }

        .btn-update {
            background: #28a745;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 8px;
            font-weight: 600;
            transition: all 0.3s;
        }

        .btn-update:hover {
            background: #218838;
            transform: scale(1.05);
        }

        .status-select {
            border: 2px solid #007bff;
            border-radius: 8px;
            padding: 8px 12px;
            font-weight: 600;
        }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <!-- Header -->
    <div class="header-bg">
        <div class="header-content">
            <h2 class="fw-bold mb-0">
                <i class="bi bi-gear"></i> Kelola Pesanan
            </h2>
            <p class="mb-0">Pesanan #{{ $pesanan->no_pesanan ?? $pesanan->idPesanan }}</p>
        </div>
    </div>

    <div class="container-fluid">
        <!-- Action Panel -->
        <div class="action-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-lightning"></i> Update Status Pesanan
            </h5>
            <form action="{{ route('pesanan.update-status', $pesanan->idPesanan) }}" method="POST">
                @csrf
                <div class="row align-items-center">
                    <div class="col-md-6 mb-3">
                        <select name="statusPesanan" class="form-select status-select" required>
                            <option value="Menunggu Penjemputan"
                                {{ $pesanan->statusPesanan == 'Menunggu Penjemputan' ? 'selected' : '' }}>Menunggu
                                Penjemputan</option>
                            <option value="Menunggu Pembayaran"
                                {{ $pesanan->statusPesanan == 'Menunggu Pembayaran' ? 'selected' : '' }}>Menunggu
                                Pembayaran</option>
                            <option value="Diproses" {{ $pesanan->statusPesanan == 'Diproses' ? 'selected' : '' }}>
                                Diproses</option>
                            <option value="Menunggu Pengantaran"
                                {{ $pesanan->statusPesanan == 'Menunggu Pengantaran' ? 'selected' : '' }}>Menunggu
                                Pengantaran</option>
                            <option value="Sudah Diantar"
                                {{ $pesanan->statusPesanan == 'Sudah Diantar' ? 'selected' : '' }}>Sudah Diantar
                            </option>
                            <option value="Selesai" {{ $pesanan->statusPesanan == 'Selesai' ? 'selected' : '' }}>Selesai
                            </option>
                        </select>
                    </div>
                    <div class="col-md-6 mb-3">
                        <button type="submit" class="btn-update w-100">
                            <i class="bi bi-check-circle"></i> Update Status
                        </button>
                    </div>
                </div>
            </form>
        </div>

        <!-- Informasi Pelanggan -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-person-badge"></i> Informasi Pelanggan
            </h5>
            <div class="row">
                <div class="col-md-4 mb-2">
                    <strong class="text-primary">Nama:</strong><br>
                    {{ $pesanan->pelanggan->namaPelanggan ?? '-' }}
                </div>
                <div class="col-md-4 mb-2">
                    <strong class="text-primary">No. HP:</strong><br>
                    <a href="tel:{{ $pesanan->pelanggan->noHp ?? '' }}" class="text-decoration-none">
                        {{ $pesanan->pelanggan->noHp ?? '-' }}
                    </a>
                </div>
                <div class="col-md-4 mb-2">
                    <strong class="text-primary">Email:</strong><br>
                    {{ $pesanan->pelanggan->email ?? '-' }}
                </div>
            </div>
            <div class="row mt-2">
                <div class="col-12">
                    <strong class="text-primary">Alamat:</strong><br>
                    <div class="p-2 bg-light rounded mt-1">
                        {{ $pesanan->pelanggan->alamat ?? 'Alamat tidak tersedia' }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Detail Pesanan -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-clipboard-data"></i> Detail Pesanan
            </h5>
            <div class="row">
                <div class="col-md-3 mb-2">
                    <strong class="text-primary">Tanggal Masuk:</strong><br>
                    {{ \Carbon\Carbon::parse($pesanan->tanggalMasuk)->format('d/m/Y H:i') }}
                </div>
                <div class="col-md-3 mb-2">
                    <strong class="text-primary">Status Saat Ini:</strong><br>
                    <span class="badge 
                        @if($pesanan->statusPesanan == 'Menunggu Penjemputan') bg-warning
                        @elseif($pesanan->statusPesanan == 'Menunggu Pembayaran') bg-danger
                        @elseif($pesanan->statusPesanan == 'Diproses') bg-info
                        @elseif($pesanan->statusPesanan == 'Menunggu Pengantaran') bg-primary
                        @elseif($pesanan->statusPesanan == 'Sudah Diantar') bg-success
                        @elseif($pesanan->statusPesanan == 'Selesai') bg-dark
                        @endif p-2">
                        {{ $pesanan->statusPesanan }}
                    </span>
                </div>
                <div class="col-md-3 mb-2">
                    <strong class="text-primary">Paket Layanan:</strong><br>
                    {{ $pesanan->layanan->namaLayanan ?? '-' }}
                </div>
                <div class="col-md-3 mb-2">
                    <strong class="text-primary">Total Biaya:</strong><br>
                    <span class="fw-bold text-success">Rp
                        {{ number_format($pesanan->total_harga ?? 0, 0, ',', '.') }}</span>
                </div>
            </div>

            <div class="row mt-3">
                <div class="col-12">
                    <strong class="text-primary">Item Laundry:</strong><br>
                    <div class="table-responsive mt-2">
                        <table class="table table-bordered">
                            <thead class="table-primary">
                                <tr>
                                    <th>Kategori</th>
                                    <th>Jumlah</th>
                                    <th>Harga Satuan</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($pesanan->detailTransaksi as $detail)
                                <tr>
                                    <td>{{ $detail->kategoriItem->namaKategori ?? '-' }}</td>
                                    <td>{{ $detail->kategoriItem->jumlahItem ?? '0' }}</td>
                                    <td>Rp {{ number_format($detail->harga_satuan ?? 0, 0, ',', '.') }}</td>
                                    <td>Rp {{ number_format($detail->subtotal ?? 0, 0, ',', '.') }}</td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="4" class="text-center text-muted">Tidak ada detail item</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Catatan Admin -->
        <div class="info-card">
            <h5 class="fw-bold text-primary mb-3">
                <i class="bi bi-pencil-square"></i> Catatan Admin
            </h5>
            <form action="{{ route('pesanan.update-catatan', $pesanan->idPesanan) }}" method="POST">
                @csrf
                <textarea name="catatan_admin" class="form-control" rows="3"
                    placeholder="Tambahkan catatan internal untuk pesanan ini...">{{ $pesanan->catatan_admin ?? '' }}</textarea>
                <button type="submit" class="btn btn-primary mt-2">
                    <i class="bi bi-save"></i> Simpan Catatan
                </button>
            </form>
        </div>

        <!-- Tombol Aksi -->
        <div class="info-card">
            <div class="row">
                <div class="col-md-6 mb-2">
                    <a href="{{ route('lihatdata.index') }}" class="btn btn-secondary w-100">
                        <i class="bi bi-arrow-left"></i> Kembali ke Daftar
                    </a>
                </div>
                <div class="col-md-6 mb-2">
                    <button class="btn btn-success w-100">
                        <i class="bi bi-printer"></i> Cetak Invoice
                    </button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>