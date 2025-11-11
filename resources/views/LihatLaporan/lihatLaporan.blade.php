<!doctype html>
<html lang="id">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <title>Lihat Laporan</title>

  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

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

    .header-wrapper {
      position: relative;
      width: 100%;
      height: 130px;
      overflow: hidden;
      border-bottom-left-radius: 40px;
      border-bottom-right-radius: 40px;
      margin-bottom: 40px;
    }

    .header-bg {
      background-image: url('water.jpg');
      background-size: cover;
      background-position: center;
      width: 100%;
      height: 100%;
      filter: brightness(0.7);
    }

    .header-content {
      position: absolute;
      top: 50%;
      left: 40px;
      transform: translateY(-50%);
      color: white;
      font-weight: 700;
      font-size: 34px;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.35);
    }

    .filter-box {
      margin: 2rem auto;
      background-color: #ffffff;
      border-radius: 1rem;
      padding: 1.5rem;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.05);
    }

    .laporan-card {
      background-color: #deebf0;
      border-radius: 2rem;
      padding: 1rem 2rem;
      margin-bottom: 1rem;
      display: flex;
      justify-content: space-between;
      align-items: center;
      box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
      transition: transform 0.2s ease;
    }

    .laporan-card:hover {
      transform: scale(1.01);
      background-color: #d9e8ff;
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

    .btn-back:hover {
      background-color: #2d5cb5;
    }
  </style>
</head>

<body>
  @include('Dashboard.karyawan_sidenav')

  <!-- HEADER -->
  <div class="header-wrapper">
    <div class="header-bg"></div>
    <div class="header-content">Lihat Laporan</div>
  </div>

  <div class="container">
    <!-- Filter Rentang Tanggal -->
    <div class="filter-box">
      <form action="{{ route('laporan.index') }}" method="GET">
        <div class="row g-3 align-items-end">
          <div class="col-md-5">
            <label class="fw-bold">Dari Tanggal:</label>
            <input type="date" name="tanggal_awal" class="form-control shadow-sm rounded-pill mt-1"
              value="{{ request('tanggal_awal') }}">
          </div>
          <div class="col-md-7">
            <label class="fw-bold">Sampai Tanggal:</label>
            <div class="input-group mt-1">
              <input type="date" name="tanggal_akhir" class="form-control shadow-sm rounded-start-pill"
                value="{{ request('tanggal_akhir') }}">
              <button type="submit" class="btn btn-primary rounded-end-pill px-3">
                <i class="bi bi-search"></i>
              </button>
            </div>
          </div>
        </div>
      </form>

      @forelse ($data as $row)
      <a href="{{ route('laporan.index') }}">
        <div class="laporan-card">
          <div>
            <h5 class="fw-bold text-primary mb-1">
              Tanggal: {{ \Carbon\Carbon::parse($row->tanggalPembayaran)->format('d M Y') }}
            </h5>
            <p class="mb-0 text-dark">ID Pembayaran: {{ $row->idTransaksiPembayaran ?? '-' }}</p>
            <p class="mb-0 text-dark">ID Transaksi: {{ $row->idDetailTransaksi }}</p>
          </div>
          <div>
            <h5 class="fw-bold text-success">
              Rp{{ number_format($row->totalPembayaran, 2, ',', '.') }}
            </h5>
          </div>
        </div>
      </a>
      @empty
      <div class="text-center text-muted mt-5">
        <p>Tidak ada laporan ditemukan.</p>
      </div>
      @endforelse
    </div>
  </div>

  <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
    <i class="bi bi-arrow-left"></i>
  </a>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>