<!doctype html>
<html lang="id">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Riwayat Pengaduan - IVA Laundry</title>

    @if (session('role') !== 'pelanggan')
    <script>window.location.href = "{{ route('login.show') }}";</script>
    @endif

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: "Poppins", sans-serif;
            background: #eef3f9;
        }
        h2 {
            text-align:center;
            margin-top:30px;
            margin-bottom:20px;
            color:#2d4b74;
            font-weight:700;
        }
        .card-pengaduan {
            background:#f8f9fc;
            padding:18px;
            border-radius:20px;
            margin-bottom:15px;
            box-shadow:0 2px 6px rgba(0,0,0,0.1);
        }
        .status {
            padding:6px 15px;
            font-weight:600;
            border-radius:12px;
            font-size:0.85rem;
        }
        .belum { background:#ffb74d; color:white; }
        .diproses { background:#64b5f6; color:white; }
        .selesai { background:#81c784; color:white; }
        .btn-detail {
            background:#2d4b74;
            color:white;
            border-radius:15px;
            padding:5px 12px;
            text-decoration:none;
        }
        .btn-detail:hover {
            background:#1d3555;
        }
    </style>
</head>

<body>

@include('Dashboard.pelanggan_sidenav')

<div class="container mt-4">
    <h2>Riwayat Pengaduan</h2>

    @forelse ($riwayat as $p)
    <div class="card-pengaduan d-flex justify-content-between align-items-center">
        <div>
            <h5>{{ $p->judulPengaduan }}</h5>
            <small class="text-muted">{{ \Carbon\Carbon::parse($p->tanggalPengaduan)->format('d M Y') }}</small>
        </div>

        <div class="d-flex align-items-center gap-2">

            @php
                $class = $p->statusPengaduan === 'Belum Ditanggapi' ? 'belum'
                        : ($p->statusPengaduan === 'Diproses' ? 'diproses' : 'selesai');
            @endphp

            <span class="status {{ $class }}">{{ $p->statusPengaduan }}</span>

            <a href="{{ route('pengaduan.show', $p->idPengaduan) }}" class="btn-detail">
                Detail
            </a>
        </div>
    </div>
    @empty
    <div class="alert alert-info text-center mt-4">
        Belum ada pengaduan yang dibuat.
    </div>
    @endforelse
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
