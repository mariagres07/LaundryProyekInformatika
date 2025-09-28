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

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light mb-4">
        <div class="container-md">
            <a class="navbar-brand" href="#">Lihat Laporan</a>
        </div>
    </nav>

    <div class="container">

        <!-- Pilih tanggal -->
        <div class="input-group mb-4">
            <span class="input-group-text bg-light">
                <i class="bi bi-calendar"></i>
            </span>
            <input type="text" class="form-control bg-light" placeholder="Pilih tanggal" readonly>
        </div>

        <!-- Tabel -->
        <div class="table-responsive">
            <table class="table table-bordered align-middle text-center">
                <thead class="table-primary">
                    <tr>
                        <th scope="col">Tanggal</th>
                        <th scope="col">ID Transaksi</th>
                        <th scope="col">Harga</th>
                    </tr>
                </thead>
                @forelse($data as $row)
                <tr>
                    <td>{{ \Carbon\Carbon::parse($row->tanggalPembayaran)->format('d M Y') }}</td>
                    <td>{{ $row->idDetailTransaksi }}</td>
                    <td>Rp{{ number_format($row->totalPembayaran, 2, ',', '.') }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="3">Tidak ada data</td>
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
    <script>
    document.querySelector(".input-group-text").addEventListener("click", function() {
        document.getElementById("tanggal").showPicker();
    });
    </script>
</body>

</html>