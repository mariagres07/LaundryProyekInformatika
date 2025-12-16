<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Pengaduan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
    body {
        background-color: #f7f9fc;
        min-height: 100vh;
    }

    .navbar {
        background-color: #7BBDE8;
    }

    .content {
        padding: 100px 30px;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .form-container {
        background: white;
        border-radius: 15px;
        box-shadow: 0 4px 15px rgba(0, 0, 0, 0.15);
        padding: 40px;
        width: 85%;
        max-width: 1100px;
    }

    .form-container h3 {
        text-align: center;
        color: #2d4b74;
        font-weight: bold;
        margin-bottom: 10px;
    }

    .form-container p {
        text-align: center;
        font-size: 14px;
        color: #555;
        margin-bottom: 25px;
    }

    .form-control {
        border-radius: 8px;
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
    }
    </style>
</head>

<body>
    @include('Dashboard.pelanggan_sidenav')

    <div class="content">
        <div class="form-container">
            <h3>Form Pengaduan</h3>
            <p>Sampaikan keluhan atau masukanmu agar layanan kami lebih baik 💬</p>

            {{-- ✅ Pesan sukses atau batal --}}
            @if (session('pesan'))
            <div class="alert alert-info alert-dismissible fade show" role="alert">
                <i class="bi bi-info-circle-fill"></i> {{ session('pesan') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            <!-- Tanggal Pengaduan -->
            @if ($mode !== 'langsung')
            <div class="card mb-4">
                <div class="card-body">
                    <form method="GET" action="{{ route('pengaduan.create') }}">
                        <label for="tanggal" class="form-label fw-semibold">Tanggal Pesanan</label>
                        <input type="date" name="tanggal" id="tanggal" value="{{ $tanggal }}" class="form-control"
                            onchange="this.form.submit()">
                    </form>
                </div>
            </div>
            @endif


            <div class="card">
                <div class="card-body">
                    <form action="{{ route('pengaduan.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf

                        <!-- Dari Detail Pesanan -->
                        @if ($mode === 'langsung')
                        <input type="hidden" name="idPesanan" value="{{ $pesananSingle->idPesanan }}">

                        <div class="mb-3">
                            <label class="form-label fw-semibold">Pesanan</label>
                            <input type="text" class="form-control"
                                value="Pesanan {{ $pesananSingle->idPesanan }} - {{ \Carbon\Carbon::parse($pesananSingle->tanggalMasuk)->format('d/m/Y') }}"
                                readonly>
                        </div>

                        <!-- Dari Dashboard -->
                        @else
                        <div class="mb-3">
                            <label for="idPesanan" class="form-label fw-semibold">Pilih Pesanan *</label>
                            <select name="idPesanan" id="idPesanan" class="form-control" required>
                                <option value="">-- Pilih Pesanan Selesai --</option>

                                @foreach ($pesanan as $p)
                                <option value="{{ $p->idPesanan }}">
                                    Pesanan {{ $p->idPesanan }} -
                                    {{ \Carbon\Carbon::parse($p->tanggalMasuk)->format('d/m/Y') }}
                                </option>
                                @endforeach

                                @if($pesanan->isEmpty())
                                <option disabled>Tidak ada pesanan selesai</option>
                                @endif
                            </select>
                        </div>
                        @endif
                        <div class="mb-3">
                            <label for="judul" class="form-label fw-semibold">Judul Pengaduan *</label>
                            <input type="text" name="judul" id="judul" class="form-control"
                                placeholder="Masukkan judul pengaduan..." required>
                        </div>

                        <div class="mb-3">
                            <label for="deskripsi" class="form-label fw-semibold">Deskripsi *</label>
                            <textarea name="deskripsi" id="deskripsi" rows="5" class="form-control"
                                placeholder="Tuliskan deskripsi pengaduanmu..." required></textarea>
                        </div>

                        <div class="mb-3">
                            <label for="lampiran" class="form-label fw-semibold">Lampiran</label>
                            <input type="file" name="lampiran" id="lampiran" class="form-control">
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <button type="submit" name="aksi" value="kirim" class="btn btn-primary px-4">
                                <i class="bi bi-send"></i> Kirim
                            </button>
                            <button type="submit" name="aksi" value="tidak" class="btn btn-secondary px-4">
                                <i class="bi bi-x-circle"></i> Batal
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- TOMBOL KEMBALI -->
    <a href="{{ route('lihatdata.detail', $pesananSingle->idPesanan) }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    {{-- Pesan hilang otomatis --}}
    <script>
    const alertBox = document.querySelector('.alert');
    if (alertBox) {
        setTimeout(() => {
            const bsAlert = new bootstrap.Alert(alertBox);
            bsAlert.close();
        }, 4000);
    }
    </script>
</body>

</html>