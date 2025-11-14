@php
use Illuminate\Support\Str;
@endphp

<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pesan Laundry</title>

    <style>
    * {
        font-family: "Poppins", sans-serif;
        box-sizing: border-box;
    }

    body {
        background-color: #eaf6ff;
        margin: 0;
        padding: 0;
    }

    /* ==== HEADER WATER FRAME ==== */
    .header-wrapper {
        position: relative;
        width: 100%;
        height: 180px;
        overflow: hidden;
        border-bottom-left-radius: 50px;
        border-bottom-right-radius: 50px;
    }

    .header-bg {
        background-image: url('water.jpg');
        background-size: cover;
        background-position: center;
        filter: brightness(0.8);
        width: 100%;
        height: 100%;
    }

    .header-content {
        position: absolute;
        top: 50%;
        left: 30px;
        transform: translateY(-50%);
        color: white;
        font-weight: bold;
        font-size: 30px;
        text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.3);
    }

    .header-content span {
        display: block;
        font-weight: 500;
        font-size: 22px;
    }

    /* ==== INPUT ALAMAT ==== */
    .alamat {
        display: flex;
        align-items: center;
        background-color: #dce9f3;
        border-radius: 20px;
        padding: 10px 20px;
        margin: 20px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .alamat input {
        border: none;
        background: transparent;
        outline: none;
        width: 100%;
        padding: 5px;
        font-size: 16px;
        color: #444;
    }

    .alamat img {
        width: 24px;
        height: 24px;
        margin-right: 10px;
    }

    /* ==== TAB SWITCH ==== */
    .tab-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #87a9c5;
        border-radius: 50px;
        margin: 0 20px 20px;
        overflow: hidden;
    }

    .tab-button {
        flex: 1;
        padding: 12px 0;
        text-align: center;
        cursor: pointer;
        color: black;
        background: transparent;
        font-weight: 500;
        transition: all 0.3s;
    }

    .tab-button.active {
        background: #dce9f3;
        border-radius: 50px;
    }

    /* ==== CARD ==== */
    .card {
        background: #dce9f3;
        border-radius: 30px;
        margin: 0 20px 20px;
        padding: 10px;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.1);
    }

    .card-header {
        display: flex;
        justify-content: space-between;
        background: #87a9c5;
        color: white;
        padding: 12px 20px;
        border-radius: 30px;
        font-weight: bold;
    }

    /* ==== ITEM KATEGORI ==== */
    .item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #e8f0f8;
        border-radius: 30px;
        padding: 10px 20px;
        margin-top: 10px;
    }

    .item .left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .item .left img {
        width: 45px;
        height: 45px;
        border-radius: 10px;
        background: white;
        padding: 5px;
        box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    }

    .counter {
        display: flex;
        align-items: center;
    }

    .counter button {
        border: none;
        background: #87a9c5;
        color: white;
        border-radius: 50%;
        width: 30px;
        height: 30px;
        font-size: 18px;
        cursor: pointer;
        transition: 0.2s;
    }

    .counter button:hover {
        background: #6d90aa;
    }

    .counter span {
        margin: 0 10px;
        font-weight: bold;
        color: #555;
    }

    /* ==== RADIO GROUP ==== */
    .radio-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        background: #e8f0f8;
        border-radius: 30px;
        padding: 10px 20px;
        margin-top: 10px;
    }

    .radio-item .left {
        display: flex;
        align-items: center;
        gap: 10px;
    }

    .radio-item img {
        width: 30px;
        height: 30px;
    }

    /* ==== BUTTON PESAN ==== */
    .btn-pesan {
        width: 90%;
        margin: 20px auto;
        padding: 12px 0;
        border: none;
        border-radius: 30px;
        font-size: 18px;
        font-weight: bold;
        display: block;
        background-color: #ccc;
        color: white;
        cursor: not-allowed;
        transition: 0.3s;
    }

    .btn-pesan.active {
        background-color: #007bff;
        cursor: pointer;
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
    </style>
</head>

<body>
    @include('Dashboard.pelanggan_sidenav')

    <!-- ==== HEADER WITH WATER BACKGROUND ==== -->
    <div class="header-wrapper">
        <div class="header-bg"></div>
        <div class="header-content">
            Pesan Laundry Sekarang! <br>
            <span>{{ $pelanggan['namaPelanggan'] ?? 'User' }}</span>
        </div>
    </div>

    <!-- ==== INPUT ALAMAT ==== -->
    <div class="alamat">
        <img src="https://static.vecteezy.com/system/resources/previews/026/122/364/non_2x/pin-icon-location-sign-in-flat-style-isolated-on-isolated-background-navigation-map-gps-concept-vector.jpg"
            alt="location">
        <input type="text" id="alamat" name="alamat" placeholder="Masukkan alamat"
            value="{{ old('alamat', $pelanggan['alamat'] ?? '') }}">
    </div>

    <!-- ==== TAB MENU ==== -->
    <div class="tab-container">
        <div class="tab-button active" id="tabKategori">Kategori Laundry</div>
        <div class="tab-button" id="tabLayanan">Jenis Paket</div>
    </div>

    <!-- ==== KATEGORI ==== -->
    <div class="card tab-content" id="contentKategori">
        @foreach ($kategoriItems ?? [] as $kategori)
        @php
        $nama = strtolower($kategori->namaKategori);
        if (Str::contains($nama, 'pakaian')) {
        $icon = 'pakaian.png';
        } elseif (Str::contains($nama, 'selimut') || Str::contains($nama, 'seprai')) {
        $icon = 'selimut.png';
        } elseif (Str::contains($nama, 'handuk')) {
        $icon = 'handuk.png';
        } else {
        $icon = 'pakaian.png';
        }
        @endphp

        <div class="item">
            <div class="left">
                <img src="{{ $icon }}" alt="{{ $kategori->namaKategori }}">
                <div>{{ $kategori->namaKategori }}</div>
            </div>
            <div class="counter">
                <button class="minus">-</button>
                <span>0</span>
                <button class="plus">+</button>
            </div>
        </div>
        @endforeach
    </div>

    <!-- ==== LAYANAN ==== -->
    <div class="card tab-content" id="contentLayanan" style="display:none;">
        @foreach ($layanans ?? [] as $layanan)
        <div class="radio-item">
            <div class="left">
                @if(Str::contains(strtolower($layanan->namaLayanan), 'express'))
                <img src="Expresslogo.png" alt="express">
                @else
                <img src="regularlogo.png" alt="regular">
                @endif
                <div>{{ $layanan->namaLayanan }}</div>
            </div>
            <input type="radio" name="layanan" value="{{ $layanan->idLayanan }}">
        </div>
        @endforeach
    </div>

    <!-- ==== TOMBOL PESAN ==== -->
    <button id="btnPesan" class="btn-pesan">Pesan Sekarang</button>

    <script>
    // === TAB SWITCH ===
    const tabKategori = document.getElementById('tabKategori');
    const tabLayanan = document.getElementById('tabLayanan');
    const contentKategori = document.getElementById('contentKategori');
    const contentLayanan = document.getElementById('contentLayanan');

    tabKategori.addEventListener('click', () => {
        tabKategori.classList.add('active');
        tabLayanan.classList.remove('active');
        contentKategori.style.display = 'block';
        contentLayanan.style.display = 'none';
    });

    tabLayanan.addEventListener('click', () => {
        tabLayanan.classList.add('active');
        tabKategori.classList.remove('active');
        contentKategori.style.display = 'none';
        contentLayanan.style.display = 'block';
    });

    // === COUNTER ===
    const plusButtons = document.querySelectorAll('.plus');
    const minusButtons = document.querySelectorAll('.minus');
    let kategoriDipilih = false;

    plusButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            let span = btn.parentElement.querySelector('span');
            span.textContent = parseInt(span.textContent) + 1;
            checkKategori();
        });
    });

    minusButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            let span = btn.parentElement.querySelector('span');
            let val = parseInt(span.textContent);
            if (val > 0) span.textContent = val - 1;
            checkKategori();
        });
    });

    function checkKategori() {
        kategoriDipilih = Array.from(document.querySelectorAll('.counter span'))
            .some(s => parseInt(s.textContent) > 0);
        checkPesanButton();
    }

    // === RADIO ===
    let layananDipilih = false;
    const radios = document.querySelectorAll('input[name="layanan"]');
    radios.forEach(r => {
        r.addEventListener('change', () => {
            layananDipilih = true;
            checkPesanButton();
        });
    });

    // === BUTTON PESAN ===
    const btnPesan = document.getElementById('btnPesan');

    function checkPesanButton() {
        if (kategoriDipilih && layananDipilih) {
            btnPesan.classList.add('active');
            btnPesan.disabled = false;
        } else {
            btnPesan.classList.remove('active');
            btnPesan.disabled = true;
        }
    }

    // === KIRIM PESAN KE BACKEND ===
    btnPesan.addEventListener('click', async () => {
        if (!btnPesan.classList.contains('active')) return;

        // Ambil jumlah tiap kategori
        const kategori = Array.from(document.querySelectorAll('.counter span')).map(s => parseInt(s
            .textContent));

        // Ambil layanan yang dipilih
        const layanan = document.querySelector('input[name="layanan"]:checked').value;

        // Ambil alamat dari input
        const alamat = document.getElementById('alamat').value;

        // Kirim ke backend
        const response = await fetch('/pesanLaundry', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json',
                'X-CSRF-TOKEN': '{{ csrf_token() }}'
            },
            body: JSON.stringify({
                kategori,
                layanan,
                alamat
            })
        });

        const data = await response.json();

        if (data.success && data.idPesanan) {
            window.location.href = `/detailPesanan/${data.idPesanan}`;
        } else {
            alert('Gagal membuat pesanan');
        }
    });
    </script>


    <a href="{{ url()->previous() }}" class="btn-back" title="Kembali">
        <i class="bi bi-arrow-left"></i>
    </a>

</body>

</html>