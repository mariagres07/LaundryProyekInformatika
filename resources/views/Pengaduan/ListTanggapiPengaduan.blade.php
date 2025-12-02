<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan - IVA Laundry</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            background-color: #f7f9fc;
            min-height: 100vh;
        }

        .content {
            padding: 100px 30px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
        }

        .container-box {
            background: white;
            border-radius: 15px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
            padding: 40px;
            width: 90%;
            max-width: 1100px;
        }

        .header-title {
            text-align: center;
            color: #2d4b74;
            font-weight: bold;
            margin-bottom: 25px;
            font-size: 28px;
        }

        .card-item {
            border-radius: 12px;
            padding: 20px;
            background: #fff;
            margin-bottom: 18px;
            border: 1px solid #eee;
            box-shadow: 0 3px 10px rgba(0, 0, 0, 0.08);
        }

        .badge-status {
            padding: 6px 12px;
            border-radius: 8px;
            font-size: 14px;
            color: white;
        }

        .badge-menunggu {
            background-color: #ff9800;
        }

        .badge-ditanggapi {
            background-color: #2196F3;
        }

        .badge-selesai {
            background-color: #4CAF50;
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
            z-index: 10;
        }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')
    <div class="content">
        <div class="container-box">
            <h3 class="header-title"><i class="bi bi-chat-left-dots"></i> Daftar Pengaduan</h3>

            {{-- Flash Messages --}}
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <i class="bi bi-check-circle"></i> {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            @if(session('error'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <i class="bi bi-exclamation-triangle"></i> {{ session('error') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert"></button>
            </div>
            @endif

            {{-- Search Section --}}
            <div class="search-section">
                <form method="GET" action="{{ route('pengaduan.index') }}" class="row g-2">
                    {{-- <div class="col-md-6">
                        <div class="input-group">
                            <span class="input-group-text"><i class="bi bi-search"></i></span>
                            <input type="text" class="form-control" name="search" 
                                placeholder="Cari berdasarkan ID Pesanan atau Deskripsi..." 
                                value="{{ $search ?? '' }}">
                        </div>
                    </div> --}}

                     <div class="col-md-3">
                        <select name="status" class="form-select">
                            @foreach($statuses as $key => $label)
                            <option value="{{ $key }}" {{ (isset($filterStatus) && $filterStatus === $key) ? 'selected' : '' }}>
                                {{ $label }}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="col-md-3">
                        <input type="date" name="start_date" class="form-control" value="{{ $startDate ?? '' }}">
                    </div>
                    <div class="col-md-3">
                        <input type="date" name="end_date" class="form-control" value="{{ $endDate ?? '' }}">
                    </div>

                    <div class="col-md-2">
                        <button type="submit" class="btn btn-primary w-100">
                            <i class="bi bi-search"></i> Cari
                        </button>
                    </div>
                    {{-- <div class="col-md-2">
                        <a href="{{ route('pengaduan.index') }}" class="btn btn-secondary w-100">
                            <i class="bi bi-arrow-clockwise"></i> Reset
                        </a>
                    </div> --}}
                </form>
            </div>

            {{-- Pengaduan List --}}
            @forelse ($pengaduan as $p)
            <div class="card-item">
                <div class="row">
                    <div class="col-md-8">
                        <h6 class="mb-2">
                            <strong>ID Pesanan:</strong> {{ $p->idPesanan ?? '-' }}
                        </h6>
                        <p class="mb-1"><strong>Judul:</strong> {{ $p->judulPengaduan ?? '-' }}</p>
                        <p class="mb-2"><strong>Deskripsi:</strong> {{ Str::limit($p->deskripsi ?? '-', 100) }}</p>
                        <small class="text-muted">
                            <i class="bi bi-calendar"></i>
                            {{ $p->tanggalPengaduan ? \Carbon\Carbon::parse($p->tanggalPengaduan)->format('d/m/Y') : '-' }}
                        </small>
                    </div>
                    <div class="col-md-4 text-end">
                        {{-- Status Badge --}}
                        <span class="badge-status
                            @if($p->statusPengaduan == 'Menunggu') badge-menunggu
                            @elseif($p->statusPengaduan == 'Ditanggapi') badge-ditanggapi
                            @elseif($p->statusPengaduan == 'Selesai') badge-selesai
                            @endif">
                            {{ $p->statusPengaduan ?? '-' }}
                        </span>

                        {{-- Media/Lampiran --}}
                        @if($p->media)
                        <p class="mt-2 mb-2">
                            <a href="{{ asset('storage/pengaduan/' . $p->media) }}" target="_blank"
                                class="btn btn-outline-info btn-sm">
                                <i class="bi bi-file-earmark"></i> Lampiran
                            </a>
                        </p>
                        @endif

                        {{-- Action Buttons --}}
                        <div class="mt-3">
                            @if(in_array($p->statusPengaduan, ['Ditanggapi', 'Selesai']))
                                <a href="{{ route('pengaduan.show', $p->idPengaduan) }}" 
                                    class="btn btn-sm btn-info">
                                    <i class="bi bi-eye"></i> Lihat
                                </a>
                            @else
                                <a href="{{ route('pengaduan.edit', $p->idPengaduan) }}" 
                                    class="btn btn-sm btn-warning">
                                    <i class="bi bi-pencil"></i> Tanggapi
                                </a>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @empty
            <div class="text-center text-muted mt-4">
                <i class="bi bi-inbox" style="font-size: 2rem;"></i>
                <p class="mt-3">Belum ada data pengaduan yang tersedia.</p>
            </div>
            @endforelse

            {{-- Pagination --}}
            @if($pengaduan->count() > 0)
            <nav aria-label="Page navigation" class="mt-4">
                {{ $pengaduan->links('pagination::bootstrap-5') }}
            </nav>
            @endif
        </div>
    </div>

    <a href="{{ url('/tampilanKaryawan') }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>