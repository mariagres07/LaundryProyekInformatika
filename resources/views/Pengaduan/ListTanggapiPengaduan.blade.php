<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Pengaduan</title>

    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        /* SAMA seperti Form Pengaduan */
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

        /* Card item styling */
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

        /* Tombol back SAMA */
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

    {{-- sidenav KARYAWAN --}}
    @include('Dashboard.karyawan_sidenav')

    <div class="content">
        <div class="container-box">

            <h3 class="header-title">Data Pengaduan</h3>

            @foreach ($pengaduans as $p)
            <div class="card-item">

                <h5>
                    Pengaduan dari:
                    <strong>{{ $p->pelanggan->nama ?? 'Tidak diketahui' }}</strong>
                </h5>

                <p class="mb-1">
                    <strong>Tanggal:</strong>
                    {{ $p->created_at ? $p->created_at->format('d M Y H:i') : '-' }}
                </p>

                <p>
                    <strong>Isi Pengaduan:</strong><br>
                    {{ $p->isiPengaduan ?? '-' }}
                </p>

                <span class="badge-status 
          @if($p->statusPengaduan == 'Menunggu') badge-menunggu
          @elseif($p->statusPengaduan == 'Ditanggapi') badge-ditanggapi
          @elseif($p->statusPengaduan == 'Selesai') badge-selesai
          @endif">
                    {{ $p->statusPengaduan ?? '-' }}
                </span>

                <br><br>

                <a href="{{ route('pengaduan.show', $p->idPengaduan) }}"
                    class="btn btn-primary btn-sm">
                    Lihat Detail
                </a>

            </div>
            @endforeach

        </div>
    </div>

    <a href="{{ url()->previous() }}" class="btn-back">
        <i class="bi bi-arrow-left"></i>
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>

</html>