<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kurir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body { margin: 0; background-color: white; font-family: Arial, sans-serif; }
    .header {
      background-image: url('water.jpg');
      background-size: cover;
      background-position: center;
      padding: 30px;
      color: white;
      font-size: 36px;
      font-weight: bold;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }
    .btn-custom {
      background-color: #003366; color: white; border-radius: 30px;
      padding: 12px 35px; font-size: 18px; font-weight: bold; margin: 5px; border: none;
    }
    .btn-custom:hover { background-color: #002244; }
    .top-bar { background-color: #5dade2; padding: 20px; border-radius: 5px 5px 0 0; text-align: center; }
    tr.table-active { background-color: #d6eaf8 !important; cursor: pointer; }
    tbody tr:hover { background-color: #f2f2f2; cursor: pointer; }
  </style>
</head>
<body>

  <div class="header">Data Kurir</div>

  <div class="container my-4">
    <!-- Search -->
    <div class="search-box">
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" class="form-control" placeholder="Cari kurir...">
      </div>
    </div>

    <!-- Tombol -->
    <div class="top-bar">
      <form method="POST" id="hapusForm" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-custom" id="btnHapus">HAPUS</button>
      </form>
      <a href="{{ url('/mkurir/input') }}" class="btn btn-custom">INPUT</a>
      <button type="button" class="btn btn-custom" id="btnEdit">EDIT</button>
    </div>

    <!-- Tabel -->
    <table class="table table-bordered text-center mb-0" id="kurirTable">
      <thead class="table-info">
        <tr>
          <th>Nama Lengkap</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kurirs as $kurir)
        <tr data-id="{{ $kurir->idKurir }}">
          <td>{{ $kurir->namaKurir }}</td>
          <td>{{ $kurir->username }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script>
    let selectedRow = null;

    // Klik baris tabel
    document.querySelectorAll("#kurirTable tbody tr").forEach(row => {
      row.addEventListener("click", () => {
        document.querySelectorAll("#kurirTable tbody tr").forEach(r => r.classList.remove("table-active"));
        row.classList.add("table-active");
        selectedRow = row;
      });
    });

    // Tombol edit -> redirect ke halaman edit
    document.getElementById("btnEdit").addEventListener("click", () => {
      if (selectedRow) {
        const idKurir = selectedRow.getAttribute("data-id");
        if (idKurir) {
          window.location.href = `/mkurir/edit/${idKurir}`;
        }
      } else {
        alert("Pilih dulu kurir yang ingin diedit.");
      }
    });

    // Tombol hapus -> submit form ke route hapus
    document.getElementById("btnHapus").addEventListener("click", () => {
      if (selectedRow) {
        const idKurir = selectedRow.getAttribute("data-id");
        if (idKurir) {
          if (confirm("Yakin ingin hapus kurir ini?")) {
            const form = document.getElementById("hapusForm");
            form.action = `/mkurir/hapus/${idKurir}`;
            form.submit();
          }
        }
      } else {
        alert("Pilih dulu kurir yang ingin dihapus.");
      }
    });
  </script>
</body>
</html>
