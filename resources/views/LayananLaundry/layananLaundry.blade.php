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
  margin: 0;
  padding: 0;
  font-family: sans-serif;
}

.background-header {
  background-color: rgba(255, 255, 255, 0.9); /* putih transparan 90% */
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
  text-shadow: none;
  margin: 0;
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
  box-shadow: inset 0 0 0 6px rgba(255,255,255,0.25);
}

.service-item {
  background: rgba(217,233,244,0.95);
  border-radius: 40px;
  padding: 14px 20px;
  margin-bottom: 12px;
  display: flex;
  align-items: center;
  justify-content: space-between;
  border: 1px solid rgba(0,0,0,0.08);
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
  transition: background-color 0.3s ease;
}

.delete-btn:hover {
  background-color: #b42323;
}

.delete-btn i {
  color: black !important;
  font-size: 1.4rem;
}

/* Tombol INPUT yang sudah diubah menjadi button */
.input-btn {
  background: #6baed6;
  border-radius: 40px;
  padding: 12px 18px;
  color: white;
  font-weight: 700;
  cursor: pointer;
  text-align: center;
  user-select: none;
  width: 100px;
  margin: 0 auto;
  display: inline-block;
  position: relative;
  z-index: 10;
  border: none;
  transition: background-color 0.3s ease;
}

.input-btn:hover,
.input-btn:focus {
  background-color: #5789b5;
  outline: none;
}

  </style>
</head>
<body class="p-4">

<div class="container">
  <div class="background-header">
    <h2 class="title">Kelola Layanan</h2>
  </div>
  
  <div class="header-bar">
    <ul class="nav nav-pills nav-pill-big justify-content-center" role="tablist">
      <li class="nav-item w-50 text-center">
        <a class="nav-link active d-inline-block" data-bs-toggle="pill" href="#tabCategories" role="tab">Kategori Laundry</a>
      </li>
      <li class="nav-item w-50 text-center">
        <a class="nav-link d-inline-block" data-bs-toggle="pill" href="#tabPakets" role="tab">Jenis Paket</a>
      </li>
    </ul>
  </div>

  <div class="tab-content">
    <!-- TAB 1: KATEGORI LAUNDRY -->
    <div id="tabCategories" class="tab-pane fade show active">
      @foreach($categories as $c)
      <div class="service-item">
        <div class="service-left">
          <img src="{{ $c->icon ? asset($c->icon) : asset('images/icon.png') }}" alt="icon">
          <div class="fw-semibold fs-5">{{ $c->nama }}</div>
        </div>

        <div class="d-flex align-items-center gap-3">
          <div class="me-2"><i class="bi bi-pencil"></i></div>
          <div class="price-input">{{ number_format($c->harga ?? 0, 0, ',', '.') }}</div>

          @if(property_exists($c, 'id'))
          <form action="{{ route('layanan.destroy', $c->id) }}" method="POST" onsubmit="return confirm('Hapus layanan ini?')">
            @csrf
            @method('DELETE')
            <button type="submit" class="delete-btn" title="Hapus layanan"><i class="bi bi-trash-fill"></i></button>
          </form>
          @else
          <button class="delete-btn" disabled><i class="bi bi-trash-fill"></i></button>
          @endif
        </div>
      </div>
      @endforeach

      <form id="inputFrameCats" class="service-item d-none" method="POST" action="{{ route('layanan.store') }}">
        @csrf
        <div class="service-left">
          <img src="{{ asset('images/icon-add.png') }}" alt="Tambah">
          <input name="nama" class="form-control border-0" placeholder="masukkan nama kategori" style="min-width:220px;" required>
        </div>

        <div class="d-flex align-items-center gap-3">
          <input name="harga" type="number" min="0" class="form-control price-input" placeholder="Harga" style="width:110px;" required>
          <button type="submit" class="btn btn-success">Simpan</button>
        </div>
      </form>
    </div>

    <!-- TAB 2: JENIS PAKET -->
    <div id="tabPakets" class="tab-pane fade">
      @foreach($pakets as $p)
      <div class="service-item">
        <div class="service-left">
          <img src="{{ $p->icon ? asset($p->icon) : asset('regularlogo.png') }}" alt="regularlogo" width="46" height="46" style="object-fit:contain; border-radius:8px;">
          <div class="fw-semibold fs-5">{{ $p->namaLayanan }}</div>
        </div>

        <div class="d-flex align-items-center gap-3">
          <div class="me-2"><i class="bi bi-pencil"></i></div>
          <div class="price-input">{{ number_format($p->hargaPerKg ?? 0, 0, ',', '.') }}</div>
          <button class="delete-btn" disabled title="Hapus paket"><i class="bi bi-trash-fill"></i></button>
        </div>
      </div>
      @endforeach

      <form id="inputFramePakets" class="service-item d-none" method="POST" action="{{ route('layanan.store') }}">
        @csrf
        <div class="service-left">
          <img src="{{ asset('Expresslogo.png') }}" alt="Tambah Paket" width="46" height="46" style="object-fit:contain; border-radius:8px;">
          <input name="namaLayanan" class="form-control border-0" placeholder="masukkan nama paket" style="min-width:220px;" required>
        </div>

        <div class="d-flex align-items-center gap-3">
          <input name="hargaPerKg" type="number" min="0" class="form-control price-input" placeholder="Harga" style="width:110px;" required>
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
  document.getElementById('btnShowInput').addEventListener('click', function() {
    const activeTab = document.querySelector('.tab-pane.show.active') || document.querySelector('.tab-pane.active');

    document.getElementById('inputFrameCats').classList.add('d-none');
    document.getElementById('inputFramePakets').classList.add('d-none');

    if (activeTab && activeTab.id === 'tabCategories') {
      document.getElementById('inputFrameCats').classList.remove('d-none');
      document.getElementById('inputFrameCats').scrollIntoView({behavior: 'smooth', block: 'center'});
    } else {
      document.getElementById('inputFramePakets').classList.remove('d-none');
      document.getElementById('inputFramePakets').scrollIntoView({behavior: 'smooth', block: 'center'});
    }
  });

  const tabLinks = document.querySelectorAll('[data-bs-toggle="pill"]');
  tabLinks.forEach(link => {
    link.addEventListener('shown.bs.tab', function () {
      document.getElementById('inputFrameCats').classList.add('d-none');
      document.getElementById('inputFramePakets').classList.add('d-none');
    });
  });
</script>
</body>
</html>
