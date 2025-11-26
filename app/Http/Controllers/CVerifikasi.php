<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\DetailTransaksi;
use App\Models\KategoriItem;
use App\Models\Layanan;

class CVerifikasi extends Controller
{
    /**
     * Menampilkan list pesanan yang perlu diverifikasi (belum ada berat)
     */
    public function index()
    {
        // Jika kamu punya cek role, bisa ditambahkan di sini (optional)
        // $role = Session::get('role'); if($role !== 'verifikator') abort(403);

        $pesanan = Pesanan::with('pelanggan')
            ->whereNull('beratBarang') // sesuai kode sebelumnya kamu pakai kolom beratBarang
            ->orderBy('tanggalMasuk', 'desc')
            ->get();

        return view('VerifikasiP.LihatVerifikasi', compact('pesanan'));
    }

    /**
     * Menampilkan detail pesanan untuk verifikasi
     */
    public function detail($id)
    {
        $pesanan = Pesanan::with(['pelanggan', 'layanan', 'detailTransaksi.kategoriItem'])
            ->findOrFail($id);

        return view('VerifikasiP.DetailVerifikasi', compact('pesanan'));
    }

    public function perhitungan(Request $request, $idPesanan)
    {
        // Ambil data pesanan berdasarkan id
        $pesanan = Pesanan::findOrFail($idPesanan);
        $layanan = Layanan::find($pesanan->idLayanan);


        $request->validate([
            'beratBarang' => 'required|numeric|min:1'
        ]);

        // Cek apakah pesanan sudah diverifikasi sebelumnya
        if ($pesanan->beratBarang !== null) {
            return back()->with('error', 'Pesanan sudah diverifikasi sebelumnya.');
        }

        // BERAT pakaian dari input verifikator
        $berat = floatval($request->beratBarang);

        // Ambil harga kategori
        $kategoriPakaian = KategoriItem::where('namaKategori', 'Pakaian')->first();
        $kategoriSprei   = KategoriItem::where('namaKategori', 'Seprai/selimt/Bed Cover')->first();
        $kategoriHanduk  = KategoriItem::where('namaKategori', 'Handuk')->first();

        // Ambil harga per item dengan Null Check (agar tidak error jika kategori tidak ditemukan)
        $hargaPakaian = $kategoriPakaian ? $kategoriPakaian->hargaPerItem : 0;
        $hargaSprei   = $kategoriSprei ? $kategoriSprei->hargaPerItem : 0;
        $hargaHanduk  = $kategoriHanduk ? $kategoriHanduk->hargaPerItem : 0;

        // Hitung total
        $totalPakaian = $berat * $hargaPakaian;
        $totalSprei   = $pesanan->seprai * $hargaSprei;
        $totalHanduk  = $pesanan->handuk * $hargaHanduk;

        $totalHarga = $totalPakaian + $totalSprei + $totalHanduk;

        // Update pesanan
        $pesanan->update([
            'beratBarang' => $berat,
            'totalHarga' => $totalHarga,
            'statusPesanan' => 'Menunggu Pembayaran'
        ]);

        // ✅ HAPUS DetailTransaksi yang duplikat!
        DetailTransaksi::where('idPesanan', $pesanan->idPesanan)->delete();

        // Pakaian (Hanya dibuat jika kategoriPakaian ditemukan)
        if ($kategoriPakaian) {
            DetailTransaksi::create([
                'idPesanan' => $pesanan->idPesanan,
                'idKategoriItem' => $kategoriPakaian->idKategoriItem,
                'jumlahKategori' => $berat,
            ]);
        }

        // Seprai (jika ada)
        if ($pesanan->seprai > 0 && $kategoriSprei) {
            DetailTransaksi::create([
                'idPesanan' => $pesanan->idPesanan,
                'idKategoriItem' => $kategoriSprei->idKategoriItem,
                'jumlahKategori' => $pesanan->seprai,
            ]);
        }

        // Handuk (jika ada)
        if ($pesanan->handuk > 0 && $kategoriHanduk) {
            DetailTransaksi::create([
                'idPesanan' => $pesanan->idPesanan,
                'idKategoriItem' => $kategoriHanduk->idKategoriItem,
                'jumlahKategori' => $pesanan->handuk,
            ]);
        }

        return redirect()->back()
            ->with('success', 'Verifikasi pemesanan berhasil dilakukan.');
    }
}
