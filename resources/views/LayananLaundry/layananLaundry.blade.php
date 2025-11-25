<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <title>Kelola Layanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet" />
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" />

  <style>
    body {
      background-color: #ffffff;
      font-family: "Poppins", sans-serif;
    }

    .background-header {
      background: url('/water.jpg') no-repeat center center;
      background-size: cover;
      height: 120px;
      margin-bottom: 20px;
      display: flex;
      align-items: center;
      justify-content: center;
      border-radius: 12px;
      box-shadow: 0 2px 6px rgba(0,0,0,0.2);
    }

    .title {
      font-weight: 800;
      color: #fff;
      font-size: 2.4rem;
      padding: 8px 20px;
      border-radius: 50px;
    }

    .header-bar {
      background: #8fb6c9;
      border-radius: 50px;
      padding: 12px;
      margin: 18px 0;
    }

    .nav-pill-big .nav-link {
      border-radius: 50px;
      padding: 0.9rem 1.6rem;
      font-weight: 600;
    }

    .nav-link.active {
      background: #dceff6;
      color: #0b3a4a;
      background-color: rgba(136, 233, 255, 0.67) !important;
    }

    .service-item {
      background: rgba(217,233,244,0.95);
      border-radius: 40px;
      padding: 14px 20px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
      gap: 12px;
    }

    .service-left {
      display: flex;
      align-items: center;
      gap: 12px;
      min-width: 280px;
    }

    .service-left img {
      width: 46px;
      height: 46px;
      object-fit: contain;
      border-radius: 8px;
    }

    .price-input, .name-input {
      border: 2px dashed #000;
      padding: 6px 8px;
      border-radius: 6px;
      background: white;
      text-align: center;
      font-weight: 600;
    }

    .price-input {
      width: 110px;
    }

    .name-input {
      min-width: 220px;
      padding-left: 12px;
      text-align: left;
      border-radius: 12px;
    }

    .update-btn {
      background: #4caf50;
      border-radius: 40px;
      padding: 6px 14px;
      color: white;
      font-weight: 700;
      cursor: pointer;
      border: none;
      transition: 0.3s;
    }

    .update-btn:hover {
      background: #3a8e36;
    }

    .delete-btn {
      background: #e43030;
      color: black;
      border-radius: 50%;
      width: 44px;
      height: 44px;
      display: flex;
      align-items: center;
      justify-content: center;
      border: none;
      cursor: pointer;
      transition: 0.3s;
    }

    .delete-btn:hover { background-color: #b42323; }

    .input-btn {
      background: #6baed6;
      border-radius: 40px;
      padding: 12px 18px;
      color: black;
      font-weight: 700;
      cursor: pointer;
      text-align: center;
      width: 100px;
      margin: 0 auto;
      border: none;
    }

    /* Tombol kembali gaya bulat di pojok kiri bawah */
    .btn-back {
      position: fixed;
      bottom: 25px;
      left: 25px;
      background-color: #8ab2d3;
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
      box-shadow: 0 4px 10px rgba(0, 0, 0, 0.25);
      text-decoration: none;
    }

    .btn-back:hover {
      background-color: #6fa2cc;
      transform: scale(1.1);
      color: white;
    }
  </style>
</head>

<body class="p-4">

@include('Dashboard.karyawan_sidenav')

<div class="container">
  <div class="background-header">
    <h2 class="title">Kelola Layanan</h2>
  </div>

  <div class="header-bar">
    <ul class="nav nav-pills nav-pill-big justify-content-center">
      <li class="nav-item w-50 text-center">
        <a class="nav-link active" data-bs-toggle="pill" href="#tabCategories">Kategori Laundry</a>
      </li>
      <li class="nav-item w-50 text-center">
        <a class="nav-link" data-bs-toggle="pill" href="#tabPakets">Jenis Paket</a>
      </li>
    </ul>
  </div>

  <div class="tab-content">
    <!-- TAB KATEGORI -->
    <div id="tabCategories" class="tab-pane fade show active">
      <div id="kategoriList">
        @forelse($categories as $c)
        <div class="service-item">
          <form action="{{ route('kategori.update', $c->idKategoriItem) }}" method="POST" class="d-flex align-items-center flex-grow-1" onsubmit="return confirm('Update kategori ini?')">
            @csrf
            @method('PUT')
            <div class="service-left">
              <img src="/{{ $c->icon ?? 'default.png' }}" alt="{{ $c->namaKategori }}">
              <input name="namaKategori" type="text" class="name-input form-control border-0" value="{{ $c->namaKategori }}" required>
            </div>
            <input name="hargaPerKg" type="number" min="0" class="price-input form-control" value="{{ $c->hargaPerItem ?? 0 }}" required>
            <button type="submit" class="update-btn">Simpan</button>
          </form>

          <form action="{{ route('kategori.destroy', $c->idKategoriItem) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn" title="Hapus kategori"><i class="bi bi-trash-fill"></i></button>
          </form>
        </div>
        @empty
        <div class="text-center text-muted mt-3">Belum ada kategori laundry.</div>
        @endforelse
      </div>

      <!-- Form tambah kategori -->
      <form id="formKategori" class="service-item d-none mt-3" method="POST" action="{{ route('kategori.store') }}">
        @csrf
        <div class="service-left">
          <img src="/default.png" alt="Tambah">
          <input name="namaKategori" class="form-control border-0" placeholder="Masukkan nama kategori" required>
        </div>
        <input name="hargaPerItem" type="number" min="0" class="form-control price-input" placeholder="Harga per kg" required>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
    </div>

    <!-- TAB JENIS PAKET -->
    <div id="tabPakets" class="tab-pane fade">
      @forelse($pakets as $p)
      <div class="service-item">
        <form action="{{ route('layanan.update', $p->idLayanan) }}" method="POST" class="d-flex align-items-center flex-grow-1" onsubmit="return confirm('Update paket ini?')">
          @csrf
          @method('PUT')
          <div class="service-left">
            <img src="/{{ $p->icon ?? 'default.png' }}" alt="{{ $p->namaLayanan }}">
            <input name="namaLayanan" type="text" class="name-input form-control border-0" value="{{ $p->namaLayanan }}" required>
          </div>
          <input name="hargaLayanan" type="number" min="0" class="price-input form-control" value="{{ $p->hargaPerKg }}" required>
          <button type="submit" class="update-btn">Simpan</button>
        </form>

        <form action="{{ route('layanan.destroy', $p->idLayanan) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
          @csrf
          @method('DELETE')
          <button type="submit" class="delete-btn" title="Hapus paket"><i class="bi bi-trash-fill"></i></button>
        </form>
      </div>
      @empty
      <div class="text-center text-muted mt-3">Belum ada paket laundry.</div>
      @endforelse

      <!-- Form tambah paket -->
      <form id="formPaket" class="service-item d-none mt-3" method="POST" action="{{ route('layanan.store') }}">
        @csrf
        <div class="service-left">
          <img src="/selimut.png" alt="Tambah">
          <input name="namaLayanan" class="form-control border-0" placeholder="Masukkan nama paket" required>
        </div>
        <input name="hargaPerKg" type="number" min="0" class="form-control price-input" placeholder="Harga paket" required>
        <button type="submit" class="btn btn-success">Simpan</button>
      </form>
    </div>
  </div>

  <div class="d-flex justify-content-center mt-3">
    <div id="btnShowInput" class="input-btn">INPUT</div>
  </div>
</div>

<!-- 🔹 Tombol kembali bundar -->
<a href="{{ url()->previous() }}" class="btn-back" title="Kembali ke Dashboard">
  <i class="bi bi-arrow-left"></i>
</a>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
  const btn = document.getElementById('btnShowInput');
  btn.addEventListener('click', () => {
    const activeTab = document.querySelector('.tab-pane.show.active');
    const formKategori = document.getElementById('formKategori');
    const formPaket = document.getElementById('formPaket');

    if (activeTab.id === 'tabCategories') {
      formKategori.classList.toggle('d-none');
      btn.textContent = formKategori.classList.contains('d-none') ? 'INPUT' : 'Tutup';
    } else {
      formPaket.classList.toggle('d-none');
      btn.textContent = formPaket.classList.contains('d-none') ? 'INPUT' : 'Tutup';
    }
  });
</script>

</body>
</html>
