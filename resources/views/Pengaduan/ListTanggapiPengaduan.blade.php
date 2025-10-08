<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Pengaduan</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
</head>

<body class="bg-light">
    <div class="container py-4">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h3 class="text-primary mb-4"><i class="bi bi-bell-fill me-2"></i>Daftar Pengaduan</h3>

                @if(session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
                @endif
                @if(session('error'))
                <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @forelse($pengaduans as $p)
                <div class="card mb-3 shadow-sm">
                    <div class="card-body">
                        <h5 class="text-primary">{{ $p->judulPengaduan }}</h5>
                        <p class="text-muted small mb-2">Tanggal: {{ \Carbon\Carbon::parse($p->tanggalPengaduan)->format('d/m/Y') }}</p>
                        <p class="text-truncate">{{ Str::limit($p->deskripsi, 100) }}</p>

                        @php
                        $badgeClass = match($p->status) {
                        'Selesai' => 'bg-success',
                        'Ditanggapi' => 'bg-info',
                        default => 'bg-warning',
                        };
                        @endphp
                        <span class="badge {{ $badgeClass }} text-white mb-3">Status: <strong>{{ $p->status ?? 'Menunggu' }}</strong></span>

                        <div class="mt-2">
                            @if(($p->status ?? 'Menunggu') != 'Selesai')
                            <a href="{{ route('pengaduan.show', $p->idPengaduan) }}" class="btn btn-sm btn-primary me-2">
                                <i class="bi bi-chat-dots me-1"></i>Tanggapi
                            </a>
                            <form action="{{ route('pengaduan.selesai', $p->idPengaduan) }}" method="POST" style="display:inline;">
                                @csrf
                                <button class="btn btn-sm btn-success" type="submit" onclick="return confirm('Apakah Anda yakin ingin menandai pengaduan ini sebagai Selesai?');">
                                    <i class="bi bi-check-circle me-1"></i>Selesai
                                </button>
                            </form>
                            @else
                            <a href="{{ route('pengaduan.show', $p->idPengaduan) }}" class="btn btn-sm btn-outline-primary">
                                <i class="bi bi-eye me-1"></i>Lihat Detail
                            </a>
                            @endif
                        </div>
                    </div>
                </div>
                @empty
                <div class="alert alert-info">Tidak ada pengaduan yang ditemukan.</div>
                @endforelse
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>