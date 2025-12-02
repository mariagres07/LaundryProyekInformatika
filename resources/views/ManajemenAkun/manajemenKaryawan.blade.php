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
            text-shadow: 2px 2px 5px rgba(0, 0, 0, 0.5);
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

        /* Notifikasi custom */
        #notifHapus {
            display: none;
            padding: 15px;
            border-radius: 10px;
            font-weight: bold;
        }

        #notifHapus button {
            margin-left: 10px;
        }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')
    <div class="header">Data Karyawan</div>

    <div class="container my-4">

        <!-- Notifikasi Hapus -->
        <div id="notifHapus" class="alert alert-danger text-center"></div>

        <div class="search-box mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-search"></i></span>
                <input type="text" id="searchInput" class="form-control" placeholder="Cari karyawan...">
            </div>
        </div>

        <div class="top-bar mb-2">
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

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let selectedRow = null;
        const notif = document.getElementById('notifHapus');

        // Pilih baris tabel
        document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
            row.addEventListener("click", () => {
                document.querySelectorAll("#karyawanTable tbody tr").forEach(r => r.classList.remove("table-active"));
                row.classList.add("table-active");
                selectedRow = row;
                notif.style.display = "none";
            });
        });

        // Tombol Edit
        document.getElementById("btnEdit").addEventListener("click", () => {
            if (selectedRow) {
                const idKaryawan = selectedRow.getAttribute("data-id");
                window.location.href = `/karyawan/edit/${idKaryawan}`;
            } else {
                notif.textContent = "Pilih karyawan yang ingin diedit!";
                notif.style.display = "block";
                setTimeout(() => {
                    notif.style.display = "none";
                }, 3000);
            }
        });

        // Tombol Hapus
        document.getElementById("btnHapus").addEventListener("click", () => {
            if (!selectedRow) {
                notif.textContent = "Pilih karyawan yang akan dihapus!";
                notif.style.display = "block";
                setTimeout(() => {
                    notif.style.display = "none";
                }, 3000);
                return;
            }

            // Tampilkan notifikasi konfirmasi hapus
            notif.innerHTML = `Yakin ingin menghapus karyawan ini?
                               <button class="btn btn-light btn-sm" id="confirmHapus">YA</button>
                               <button class="btn btn-light btn-sm" id="cancelHapus">BATAL</button>`;
            notif.style.display = "block";

            document.getElementById("confirmHapus").addEventListener("click", () => {
                const idKaryawan = selectedRow.getAttribute("data-id");
                const form = document.getElementById("hapusForm");
                form.action = `/karyawan/hapus/${idKaryawan}`;
                form.submit();
            });

            document.getElementById("cancelHapus").addEventListener("click", () => {
                notif.style.display = "none";
            });
        });

        // Pencarian langsung
        document.getElementById("searchInput").addEventListener("keyup", function() {
            const keyword = this.value.toLowerCase();
            document.querySelectorAll("#karyawanTable tbody tr").forEach(row => {
                const rowText = row.textContent.toLowerCase();
                row.style.display = rowText.includes(keyword) ? "" : "none";
            });
        });
    </script>

    <script src="{{ asset('js/dashboard.js') }}"></script>

    <!-- Tombol kembali -->
    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>

</html>