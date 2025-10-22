// Fungsi utama yang menangani logika Tab dan Redirect
function handleTabClick(targetId) {
    const dashboardElement = document.getElementById('dashboard');

    // Asumsi: Jika elemen 'dashboard' ada, berarti kita berada di halaman Tampilan Karyawan.
    if (dashboardElement) {
        // --- 1. Logika Tampilkan/Sembunyikan Tab (Saat di halaman Dashboard) ---

        // Sembunyikan semua konten
        document.getElementById('dashboard').classList.add('hidden');
        document.getElementById('pengguna').classList.add('hidden');
        document.getElementById('laundry').classList.add('hidden');

        // Tampilkan konten yang diminta
        const targetElement = document.getElementById(targetId);
        if (targetElement) {
            targetElement.classList.remove('hidden');
        }
    } else {
        // --- 2. Logika Pengalihan Halaman (Saat di halaman Lihat Laporan) ---

        // Ganti '/tampilanKaryawan' dengan URL (route) yang benar
        // Tambahkan query parameter 'tab' = targetId (misalnya: /tampilanKaryawan?tab=pengguna)
        window.location.href = '/tampilanKaryawan?tab=' + targetId;
    }
}

// Fungsi Panggilan (tetap menggunakan nama lama)
function showDashboard() {
    handleTabClick('dashboard');
}

function showPengguna() {
    handleTabClick('pengguna');
}

function showLaundry() {
    handleTabClick('laundry');
}