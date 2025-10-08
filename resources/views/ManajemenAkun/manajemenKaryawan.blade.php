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
            /* PENTING: Ganti 'water.jpg' dengan path gambar Anda, atau gunakan URL online */
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
            background-color: #003366; /* Biru tua */
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
            background-color: #002244; /* Biru lebih tua */
        }
        .top-bar {
            background-color: #5dade2; /* Biru muda */
            padding: 15px;
            border-radius: 5px 5px 0 0;
            text-align: center;
        }
        /* Style untuk baris yang aktif/dipilih */
        tr.table-active {
            background-color: #d6eaf8 !important; /* Biru sangat muda */
            cursor: pointer;
        }
        /* Style saat mouse hover di baris tabel */
        tbody tr:hover {
            background-color: #eaf2f8;
            cursor: pointer;
        }
    </style>
</head>
<body>

    <div class="header">Data Karyawan</div>

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
            <a href="{{ url('/mkaryawan/create') }}" class="btn btn-custom">INPUT</a>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

    <script>
        let selectedRow = null;

        // FUNGSI: Memilih baris tabel saat diklik
        document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
            row.addEventListener("click", () => {
                // Hapus class 'table-active' dari semua baris
                document.querySelectorAll("#karyawanTable tbody tr").forEach(r => r.classList.remove("table-active"));
                // Tambahkan class 'table-active' ke baris yang diklik
                row.classList.add("table-active");
                // Simpan baris yang dipilih
                selectedRow = row;
            });
        });

        // FUNGSI: Tombol Edit
        document.getElementById("btnEdit").addEventListener("click", () => {
            if (selectedRow) {
                const idKaryawan = selectedRow.getAttribute("data-id");
                // Arahkan ke halaman edit dengan ID karyawan yang dipilih
                window.location.href = `/mkaryawan/edit/${idKaryawan}`;
            } else {
                alert("Pilih dulu karyawan yang ingin diedit.");
            }
        });

        // FUNGSI: Tombol Hapus
        document.getElementById("btnHapus").addEventListener("click", () => {
            if (selectedRow) {
                const idKaryawan = selectedRow.getAttribute("data-id");
                if (confirm("Yakin ingin menghapus karyawan ini?")) {
                    const form = document.getElementById("hapusForm");
                    // Atur action form sesuai ID karyawan yang dipilih
                    form.action = `/mkaryawan/hapus/${idKaryawan}`;
                    form.submit();
                }
            } else {
                alert("Pilih dulu karyawan yang ingin dihapus.");
            }
        });

        // FUNGSI: Pencarian langsung (live search)
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
                const rowText = row.textContent.toLowerCase();
                // Tampilkan baris jika cocok dengan keyword, sembunyikan jika tidak
                row.style.display = rowText.includes(keyword) ? "" : "none";
            });
        });
    </script>

</body>
</html>