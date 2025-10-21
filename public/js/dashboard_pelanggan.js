// Fungsi utama yang menangani logika Tab dan Redirect untuk Pelanggan
function handlePelangganTabClick(targetId) {
    // Cek apakah elemen 'pesanlaundry' (indikasi halaman utama Pelanggan) ada.
    const utamaElement = document.getElementById('pesanlaundry');

    if (utamaElement) {
        // --- 1. Logika Tampilkan/Sembunyikan Tab (Saat di halaman Dashboard Pelanggan) ---

        // Sembunyikan semua konten tab
        document.getElementById('pesanlaundry').classList.add('hidden');
        document.getElementById('lihatdatapesanan').classList.add('hidden');
        document.getElementById('editprofil').classList.add('hidden');

        // Tampilkan konten yang diminta
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.classList.remove('hidden');
        }
    } else {
        // --- 2. Logika Pengalihan Halaman (Saat di halaman lain, misalnya /pesanLaundry) ---

        // Alihkan pengguna ke Dashboard utama dengan parameter tab yang diminta
        window.location.href = '/tampilanPelanggan?tab=' + targetId;
    }
}

// Fungsi Panggilan
function showPesanLaundry() {
    handlePelangganTabClick('pesanlaundry');
}

function showLihatDataPesanan() {
    handlePelangganTabClick('lihatdatapesanan');
}

function showEditProfil() {
    handlePelangganTabClick('editprofil');
}