<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Data Karyawan</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            margin: 0;
            background-color: #f4f7f6;
            font-family: Arial, sans-serif;
        }
        .header {
            background-image: url('water.jpg');
            background-size: cover;
            background-position: center;
            padding: 30px;
            color: white;
            font-size: 36px;
            font-weight: bold;
            text-shadow: 2px 2px 5px rgba(0,0,0,0.5);
            text-align: left;
        }
        .btn-custom {
            background-color: #003366;
            color: white;
            border-radius: 30px;
            padding: 10px 30px;
            font-size: 16px;
            font-weight: bold;
            margin: 5px;
            border: none;
            transition: background-color 0.3s;
        }
        .btn-custom:hover {
            background-color: #002244;
        }
        .top-bar {
            background-color: #5dade2;
            padding: 15px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        tr.table-active {
            background-color: #d6eaf8 !important; 
            cursor: pointer;
        }
        tbody tr:hover {
            background-color: #eaf2f8;
            cursor: pointer;
        }
        /* 🔹 Tombol kembali kanan bawah */
        .btn-kembali-bawah {
            position: fixed;
            bottom: 30px;
            right: 40px;
            background-color: #003366;
            color: white;
            border-radius: 30px;
            padding: 10px 25px;
            font-size: 15px;
            font-weight: bold;
            text-decoration: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: background-color 0.3s, transform 0.2s;
        }
        .btn-kembali-bawah:hover {
            background-color: #002244;
            transform: scale(1.05);
        }
    </style>
</head>
<body>

    <div class="header">
        Data Karyawan
    </div>

    <div class="container my-4">
        <div class="search-box">
            <div class="input-group mb-3">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari berdasarkan nama, username, atau No HP...">
            </div>
        </div>

        <div class="top-bar">
            <form method="POST" id="hapusForm" style="display:inline;">
                @csrf
                @method('DELETE')
                <button type="button" class="btn btn-custom" id="btnHapus">HAPUS</button>
            </form>
            <a href="{{ url('/karyawan/create') }}" class="btn btn-custom">INPUT</a>
            <button type="button" class="btn btn-custom" id="btnEdit">EDIT</button>
        </div>

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

    <!-- 🔹 Tombol kembali di kanan bawah -->
    <a href="{{ url('/masuk') }}" class="btn-kembali-bawah">
        <i class="bi bi-arrow-left"></i> Kembali
    </a>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let selectedRow = null;

        // Pilih baris tabel saat diklik
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
                window.location.href = `/karyawan/edit/${idKaryawan}`;
            } else {
                alert("Pilih dulu karyawan yang ingin diedit.");
            }
        });

        // Tombol Hapus
        document.getElementById("btnHapus").addEventListener("click", () => {
            if (selectedRow) {
                const idKaryawan = selectedRow.getAttribute("data-id");
                if (confirm("Yakin ingin menghapus karyawan ini?")) {
                    const form = document.getElementById("hapusForm");
                    form.action = `/karyawan/hapus/${idKaryawan}`;
                    form.submit();
                }
            } else {
                alert("Pilih dulu karyawan yang ingin dihapus.");
            }
        });

        // Live Search
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(keyword) ? "" : "none";
            });
        });
    </script>

</body>
</html>
