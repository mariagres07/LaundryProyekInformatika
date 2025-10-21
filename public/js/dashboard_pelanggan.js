// Fungsi utama untuk Pelanggan, disesuaikan agar default ke dashboard_utama
function handlePelangganTabClick(targetId) {
    // Cek keberadaan elemen utama untuk menentukan lokasi.
    const utamaElement = document.getElementById('dashboard_utama');

    if (utamaElement) {
        // --- 1. Logika Tampilkan/Sembunyikan Tab (Saat di halaman Dashboard Pelanggan) ---

        // Sembunyikan semua konten tab, termasuk dashboard_utama
        document.getElementById('dashboard_utama').classList.add('hidden');
        document.getElementById('pesanlaundry').classList.add('hidden');
        document.getElementById('lihatdatapesanan').classList.add('hidden');
        document.getElementById('editprofil').classList.add('hidden');

        // Tampilkan konten yang diminta
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.classList.remove('hidden');
        }
    } else {
        // --- 2. Logika Pengalihan Halaman (Saat di halaman lain) ---

        // Ganti '/tampilanPelanggan' dengan URL/Route yang benar ke dashboard pelanggan
        window.location.href = '/tampilanPelanggan?tab=' + targetId;
    }
}

// Fungsi Panggilan
function showDashboardPelanggan() {
    handlePelangganTabClick('dashboard_utama');
}

function showPesanLaundry() {
    handlePelangganTabClick('pesanlaundry');
}

function showLihatDataPesanan() {
    handlePelangganTabClick('lihatdatapesanan');
}

function showEditProfil() {
    handlePelangganTabClick('editprofil');
}