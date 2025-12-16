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
        text-align: left;
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

    /* Notifikasi custom */
    #notifKurir {
        display: none;
        padding: 15px;
        border-radius: 10px;
        font-weight: bold;
        margin-bottom: 10px;
    }

    #notifKurir button {
        margin-left: 10px;
    }
    </style>
</head>

<body>

    @include('Dashboard.karyawan_sidenav')

    <div class="header">Data Kurir</div>

    <div class="container my-4">

        <!-- Notifikasi -->
        <div id="notifKurir" class="alert alert-danger text-center"></div>

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

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    @if (session('success'))
    <script>
    Swal.fire({
        icon: 'success',
        title: 'Berhasil!',
        text: "{{ session('success') }}",
        timer: 2000,
        showConfirmButton: false
    });
    </script>
    @endif

    @if (session('error'))
    <script>
    Swal.fire({
        icon: 'error',
        title: 'Gagal!',
        text: "{{ session('error') }}",
        confirmButtonColor: '#d33'
    });
    </script>
    @endif

    <script>
    let selectedRow = null;
    const notif = document.getElementById('notifKurir');

    // Pilih baris tabel
    document.querySelectorAll("#kurirTable tbody tr").forEach(row => {
        row.addEventListener("click", () => {
            document.querySelectorAll("#kurirTable tbody tr").forEach(r => r.classList.remove(
                "table-active"));
            row.classList.add("table-active");
            selectedRow = row;
            notif.style.display = "none";
        });
    });

    // Tombol Edit
    document.getElementById("btnEdit").addEventListener("click", () => {
        if (selectedRow) {
            const id = selectedRow.dataset.id;
            window.location.href = `/mkurir/edit/${id}`;
        } else {
            notif.textContent = "Pilih kurir yang ingin diedit!";
            notif.style.display = "block";
            setTimeout(() => {
                notif.style.display = "none";
            }, 3000);
        }
    });
    // Tombol Hapus 
    document.getElementById("btnHapus").addEventListener("click", () => {
        if (!selectedRow) {
            Swal.fire({
                icon: 'info',
                title: 'Perhatian',
                text: 'Silakan pilih kurir terlebih dahulu.',
                confirmButtonColor: '#0d6efd' // biru bootstrap
            });
            return;
        }

        const id = selectedRow.dataset.id;
        const nama = selectedRow.children[0].innerText;

        Swal.fire({
            title: 'Konfirmasi Penghapusan',
            html: `Apakah kamu yakin ingin menghapus <b>${nama}</b>?`,
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Ya, hapus',
            cancelButtonText: 'Batal',
            confirmButtonColor: '#0d6efd', // biru
            cancelButtonColor: '#adb5bd', // abu soft
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                const form = document.getElementById("hapusForm");
                form.action = `/mkurir/hapus/${id}`;
                form.submit();
            }
        });
    });
    </script>
    <script src="{{ asset('js/dashboard.js') }}"></script>

    <!-- Tombol kembali -->
    <a href="{{ url('/tampilanKaryawan?tab=pengguna') }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>
</body>

</html>