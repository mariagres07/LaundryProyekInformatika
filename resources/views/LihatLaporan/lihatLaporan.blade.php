<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Lihat Laporan</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>

<body class="bg-white">
    @include('Dashboard.karyawan_sidenav')

    <!-- Header -->
    <div class="text-center p-4 mb-4"
        style="background:url('https://i.ibb.co/Nn6g8jV/water-bg.jpg') no-repeat center/cover;">
        <h3 class="fw-bold text-light" style="font-size:3rem; text-shadow:2px 2px 4px #000;">
            Lihat Laporan
        </h3>
    </div>

    <div class="container">

        <!-- Form Filter Rentang Tanggal -->
        <form action="{{ route('laporan.index') }}" method="GET" class="mb-4">
            <div class="row">
                <!-- Dari Tanggal -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Dari Tanggal:</label>
                    <div class="d-flex gap-2">
                        <select name="tanggal_awal" class="form-select bg-light">
                            <option value="">Tanggal</option>
                            @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                        <select name="bulan_awal" class="form-select bg-light">
                            <option value="">Bulan</option>
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                @endfor
                        </select>
                        <select name="tahun_awal" class="form-select bg-light">
                            <option value="">Tahun</option>
                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>

                <!-- Sampai Tanggal -->
                <div class="col-md-6">
                    <label class="form-label fw-bold">Sampai Tanggal:</label>
                    <div class="d-flex gap-2">
                        <select name="tanggal_akhir" class="form-select bg-light">
                            <option value="">Tanggal</option>
                            @for ($i = 1; $i <= 31; $i++) <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                        </select>
                        <select name="bulan_akhir" class="form-select bg-light">
                            <option value="">Bulan</option>
                            @for ($i = 1; $i <= 12; $i++) <option value="{{ $i }}">
                                {{ DateTime::createFromFormat('!m', $i)->format('F') }}</option>
                                @endfor
                        </select>
                        <select name="tahun_akhir" class="form-select bg-light">
                            <option value="">Tahun</option>
                            @for ($i = now()->year; $i >= now()->year - 5; $i--)
                            <option value="{{ $i }}">{{ $i }}</option>
                            @endfor
                        </select>
                    </div>
                </div>
            </div>

            <!-- Tombol Cari -->
            <div class="text-center mt-4">
                <button type="submit" class="btn btn-primary rounded-pill px-4">
                    <i class="bi bi-search"></i> Cari
                </button>
            </div>
        </form>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">ID Pembayaran</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                @forelse($data as $row)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row->tanggalPembayaran)->format('d M Y') }}</td>
                    <td>{{ $row->idTransaksiPembayaran ?? '-' }}</td>
                    <td>{{ $row->idDetailTransaksi }}</td>
                    <td>Rp{{ number_format($row->totalPembayaran, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="4">Tidak ada data</td>
                </tr>
                @endforelse
            </table>
        </div>

        <!-- Tombol kembali -->
        <div class="mb-3">
            <a href="{{ url()->previous() }}" class="btn btn-secondary rounded-pill px-4">
                <i class="bi bi-arrow-left"></i> Kembali
            </a>
        </div>
    </div>

    <!-- Bootstrap Icons + JS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('js/dashboard.js') }}"></script>
</body>

</html>