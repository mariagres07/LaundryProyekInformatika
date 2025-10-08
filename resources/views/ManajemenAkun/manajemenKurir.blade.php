<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Karyawan</title>

  <!-- Bootstrap -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

  <style>
    body {
      margin: 0;
      background-color: white;
      font-family: Arial, sans-serif;
    }
    .header {
      background-image: url('water.jpg'); /* ganti dengan path gambar air kamu */
      background-size: cover;
      background-position: center;
      padding: 30px;
      color: white;
      font-size: 36px;
      font-weight: bold;
      text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
    }
    .btn-custom {
      background-color: #003366;
      color: white;
      border-radius: 30px;
      padding: 12px 35px;
      font-size: 18px;
      font-weight: bold;
      margin: 5px;
      border: none;
    }
    .btn-custom:hover {
      background-color: #002244;
    }
    .top-bar {
      background-color: #5dade2;
      padding: 20px;
      border-radius: 5px 5px 0 0;
      text-align: center;
    }
    tr.table-active {
      background-color: #d6eaf8 !important;
      cursor: pointer;
    }
    tbody tr:hover {
      background-color: #f2f2f2;
      cursor: pointer;
    }
  </style>
</head>
<body>

  <!-- Header -->
  <div class="header">Data Karyawan</div>

  <div class="container my-4">
    <!-- Search -->
    <div class="search-box">
      <div class="input-group mb-3">
        <span class="input-group-text"><i class="bi bi-search"></i></span>
        <input type="text" id="searchInput" class="form-control" placeholder="Cari karyawan...">
      </div>
    </div>

    <!-- Tombol -->
    <div class="top-bar">
      <form method="POST" id="hapusForm" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-custom" id="btnHapus">HAPUS</button>
      </form>
      <a href="{{ url('/mkaryawan/input') }}" class="btn btn-custom">INPUT</a>
      <button type="button" class="btn btn-custom" id="btnEdit">EDIT</button>
    </div>

    <!-- Tabel -->
    <table class="table table-bordered text-center mb-0" id="karyawanTable">
      <thead class="table-info">
        <tr>
          <th>Nama Lengkap</th>
          <th>Username</th>
          <th>No HP</th>
        </tr>
      </thead>
      <tbody>
        @foreach($karyawan as $k)
        <tr data-id="{{ $k->idKaryawan }}">
          <td>{{ $k->namaKaryawan }}</td>
          <td>{{ $k->username }}</td>
          <td>{{ $k->noHp }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <!-- Bootstrap Script -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

  <script>
    let selectedRow = null;

    // Pilih baris tabel
    document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
      row.addEventListener("click", () => {
        document.querySelectorAll("#karyawanTable tbody tr").forEach(r => r.classList.remove("table-active"));
        row.classList.add("table-active");
        selectedRow = row;
      });
    });

    // Tombol Edit
    document.getElementById("btnEdit").addEventListener("click", () => {
      if (selectedRow) {
        const idKaryawan = selectedRow.getAttribute("data-id");
        if (idKaryawan) {
          window.location.href = `/mkaryawan/edit/${idKaryawan}`;
        }
      } else {
        alert("Pilih dulu karyawan yang ingin diedit.");
      }
    });

    // Tombol Hapus
    document.getElementById("btnHapus").addEventListener("click", () => {
      if (selectedRow) {
        const idKaryawan = selectedRow.getAttribute("data-id");
        if (idKaryawan) {
          if (confirm("Yakin ingin hapus karyawan ini?")) {
            const form = document.getElementById("hapusForm");
            form.action = `/mkaryawan/hapus/${idKaryawan}`;
            form.submit();
          }
        }
      } else {
        alert("Pilih dulu karyawan yang ingin dihapus.");
      }
    });

    // Fitur pencarian langsung
    document.getElementById("searchInput").addEventListener("keyup", function() {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
      });
    });
  </script>

</body>
</html>
