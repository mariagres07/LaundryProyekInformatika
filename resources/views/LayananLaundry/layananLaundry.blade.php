<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kelola Layanan</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">

  <style>
    body {
      background: url('{{ asset('water.jpg') }}') no-repeat center center fixed;
      background-size: cover;
      font-family: sans-serif;
    }
    .background-header {
      background-color: rgba(255, 255, 255, 0.9);
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
      color: #0b3a4a;
      font-size: 2.4rem;
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
    .nav-pill-big .nav-link.active {
      background: #dceff6;
      color: #0b3a4a;
    }
    .service-item {
      background: rgba(217,233,244,0.95);
      border-radius: 40px;
      padding: 14px 20px;
      margin-bottom: 12px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }
    .service-left {
      display: flex;
      align-items: center;
      gap: 12px;
    }
    .service-left img {
      width: 46px;
      height: 46px;
      object-fit: contain;
      border-radius: 8px;
    }
    .price-input {
      width: 110px;
      text-align: center;
      border: 2px dashed #000;
      padding: 6px 8px;
      border-radius: 6px;
      background: white;
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
  </style>
</head>

<body class="p-4">
<div class="container">
  <div class="background-header">
    <h2 class="title">Kelola Layanan Laundry</h2>
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
    <!-- TAB 1: KATEGORI LAUNDRY -->
    <div id="tabCategories" class="tab-pane fade show active">
      <div id="kategoriList">
        @forelse($categories as $c)
        <div class="service-item kategori-item">
          <div class="service-left">
            <img src="{{ asset('logo.png') }}" alt="icon">
            <div class="fw-semibold fs-5">{{ $c->namaKategori }}</div>
          </div>
          <div class="d-flex align-items-center gap-3">
            <input type="number" class="form-control price-input" placeholder="Harga (tidak disimpan)">
            <form action="{{ route('kategori.destroy', $c->idKategoriItem) }}" method="POST" onsubmit="return confirm('Hapus kategori ini?')">
              @csrf
              @method('DELETE')
              <button type="submit" class="delete-btn"><i class="bi bi-trash-fill"></i></button>
            </form>
          </div>
        </div>
        @empty
        <div class="text-center text-muted mt-3">Belum ada kategori laundry.</div>
        @endforelse
      </div>

      <!-- Form input kategori -->
      <form id="formKategori" class="service-item d-none mt-3" method="POST" action="{{ route('kategori.store') }}">
        @csrf
        <div class="service-left">
          <img src="{{ asset('logo.png') }}" alt="Tambah">
          <input name="namaKategori" class="form-control border-0" placeholder="Masukkan nama kategori" style="min-width:220px;" required>
        </div>
        <div class="d-flex align-items-center gap-3">
          <input type="number" min="0" class="form-control price-input" placeholder="Harga (tidak disimpan)" style="width:150px;">
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>

    <!-- TAB 2: JENIS PAKET -->
    <div id="tabPakets" class="tab-pane fade">
      @forelse($pakets as $p)
      <div class="service-item">
        <div class="service-left">
          <img src="{{ asset('Expresslogo.png') }}" alt="icon">
          <div class="fw-semibold fs-5">{{ $p->namaLayanan }}</div>
        </div>
        <div class="d-flex align-items-center gap-3">
          <div class="price-input">Rp {{ number_format($p->hargaPerKg, 0, ',', '.') }}</div>
          <form action="{{ route('layanan.destroy', $p->idLayanan) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn"><i class="bi bi-trash-fill"></i></button>
          </form>
        </div>
      </div>
      @empty
      <div class="text-center text-muted mt-3">Belum ada paket laundry.</div>
      @endforelse

      <!-- Form input paket -->
      <form id="formPaket" class="service-item d-none mt-3" method="POST" action="{{ route('layanan.store') }}">
        @csrf
        <div class="service-left">
          <img src="{{ asset('Expresslogo.png') }}" alt="Tambah">
          <input name="namaLayanan" class="form-control border-0" placeholder="Masukkan nama paket" style="min-width:220px;" required>
        </div>
        <div class="d-flex align-items-center gap-3">
          <input name="hargaPerKg" type="number" min="0" class="form-control price-input" placeholder="Harga" style="width:150px;" required>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>
  </div>

  <div class="d-flex justify-content-center mt-3">
    <div id="btnShowInput" class="input-btn">INPUT</div>
  </div>
</div>

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
