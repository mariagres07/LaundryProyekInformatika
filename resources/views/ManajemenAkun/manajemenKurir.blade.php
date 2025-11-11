<!DOCTYPE html>
<html lang="id">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Data Kurir</title>
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">
  <style>
    body {
      margin: 0;
      font-family: Arial, sans-serif;
      background-color: white;
    }

    .header {
      background-image: url('water.jpg');
      background-size: cover;
      background-position: center;
      padding: 35px;
      color: white;
      font-size: 36px;
      font-weight: bold;
      text-align: center;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.6);
    }

    .btn-custom {
      background-color: #003366;
      color: white;
      border-radius: 25px;
      padding: 10px 30px;
      font-weight: bold;
      margin: 5px;
      border: none;
    }

    .btn-custom:hover {
      background-color: #002244;
    }

    /* ==== TOMBOL KEMBALI ==== */
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

    .top-bar {
      background-color: #5dade2;
      padding: 20px;
      border-radius: 10px 10px 0 0;
      text-align: center;
    }

    tr.table-active {
      background-color: #d6eaf8 !important;
    }

    tbody tr:hover {
      background-color: #f2f2f2;
      cursor: pointer;
    }
  </style>
</head>

<body>

  @include('Dashboard.karyawan_sidenav')

  <div class="header">Data Kurir</div>

  <div class="container my-4">
    <div class="input-group mb-3">
      <span class="input-group-text"><i class="bi bi-search"></i></span>
      <input type="text" id="searchInput" class="form-control" placeholder="Cari kurir...">
    </div>

    <div class="top-bar">
      <form method="POST" id="hapusForm" style="display:inline;">
        @csrf
        @method('DELETE')
        <button type="button" class="btn btn-custom" id="btnHapus">HAPUS</button>
      </form>
      <a href="{{ url('/mkurir/input') }}" class="btn btn-custom">INPUT</a>
      <button type="button" class="btn btn-custom" id="btnEdit">EDIT</button>
    </div>

    <table class="table table-bordered text-center mb-0" id="kurirTable">
      <thead class="table-info">
        <tr>
          <th>Nama Lengkap</th>
          <th>Username</th>
        </tr>
      </thead>
      <tbody>
        @foreach($kurir as $k)
        <tr data-id="{{ $k->idKurir }}">
          <td>{{ $k->namaKurir }}</td>
          <td>{{ $k->username }}</td>
        </tr>
        @endforeach
      </tbody>
    </table>
  </div>

  <script>
    let selectedRow = null;

    document.querySelectorAll("#kurirTable tbody tr").forEach(row => {
      row.addEventListener("click", () => {
        document.querySelectorAll("#kurirTable tbody tr").forEach(r => r.classList.remove("table-active"));
        row.classList.add("table-active");
        selectedRow = row;
      });
    });

    document.getElementById("btnEdit").addEventListener("click", () => {
      if (selectedRow) {
        const id = selectedRow.dataset.id;
        window.location.href = `/mkurir/edit/${id}`;
      } else alert("Pilih dulu kurir yang ingin diedit.");
    });

    document.getElementById("btnHapus").addEventListener("click", () => {
      if (selectedRow) {
        const id = selectedRow.dataset.id;
        if (confirm("Yakin ingin hapus kurir ini?")) {
          const form = document.getElementById("hapusForm");
          form.action = `/mkurir/hapus/${id}`;
          form.submit();
        }
      } else alert("Pilih dulu kurir yang ingin dihapus.");
    });

    document.getElementById("searchInput").addEventListener("keyup", function() {
      const keyword = this.value.toLowerCase();
      document.querySelectorAll("#kurirTable tbody tr").forEach(row => {
        const text = row.textContent.toLowerCase();
        row.style.display = text.includes(keyword) ? "" : "none";
      });
    });
  </script>

  <script src="{{ asset('js/dashboard.js') }}"></script>

  <!-- Tombol kembali -->
  <a href="javascript:history.back()" class="btn-back" title="Kembali">
    <i class="bi bi-arrow-left"></i>
  </a>

</body>

</html>