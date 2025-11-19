<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\DetailTransaksi;

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

    /**
     * Melakukan perhitungan total harga dan menyimpan berat barang.
     *
     * Aturan:
     * - Pakaian: dihitung berdasarkan berat (kg) * hargaPerItem (dari kategori_item)
     * - Seprai & Handuk (dan kategori lain selain Pakaian): dihitung per pcs * hargaPerItem
     */
    public function perhitungan(Request $request, $id)
    {
        // Ambil data pesanan berdasarkan id
        $pesanan = Pesanan::findOrFail($id);

        // Ambil harga dari tabel kategoriitem (nama tabel sesuai database kamu)
        $hargaPakaian = DB::table('kategoriitem')->where('namaKategori', 'Pakaian')->value('hargaPerItem');
        $hargaSprei   = DB::table('kategoriitem')->where('namaKategori', 'Seprai')->value('hargaPerItem');
        $hargaHanduk  = DB::table('kategoriitem')->where('namaKategori', 'Handuk')->value('hargaPerItem');

        // Ambil jumlah item dari tabel pesanan
        $jumlahPakaian = $pesanan->pakaian; // Pakaian dihitung berdasarkan berat
        $jumlahSprei   = $pesanan->seprai;
        $jumlahHanduk  = $pesanan->handuk;

        // Berat pakaian yang diinput verifikator
        $berat = floatval($request->beratBarang);

        // ============================
        //      PROSES PERHITUNGAN
        // ============================

        // Pakaian = berat × harga
        $totalPakaian = $berat * $hargaPakaian;
        $totalSprei   = $jumlahSprei * $hargaSprei;
        $totalHanduk  = $jumlahHanduk * $hargaHanduk;

        // Total keseluruhan
        $totalHarga = $totalPakaian + $totalSprei + $totalHanduk;

        $request->validate([
            'beratBarang' => 'required|numeric|min:1'
        ]);

        // Ambil data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);

        // Jika sudah diverifikasi, tidak boleh ditimbang ulang
        if ($pesanan->beratBarang !== null) {
            return back()->with('error', 'Pesanan sudah diverifikasi sebelumnya.');
        }

        // Simpan berat barang yang diinputkan user
        $pesanan->beratBarang = $request->beratBarang;

        // Update status pesanan (tanpa menghitung total harga)
        $pesanan->statusPesanan = 'Diproses';

        // Simpan hasil ke DB
        $pesanan->update([
            'beratBarang' => $berat,
            'totalHarga'  => $totalHarga,
            'statusPesanan' => 'Menunggu Pembayaran'
        ]);

        $kategoriPakaian = \App\Models\KategoriItem::where('namaKategori', 'Pakaian')->first();
        $kategoriSprei   = \App\Models\KategoriItem::where('namaKategori', 'Seprai')->first();
        $kategoriHanduk  = \App\Models\KategoriItem::where('namaKategori', 'Handuk')->first();

        DetailTransaksi::create([
            'idPesanan' => $pesanan->idPesanan,
            'idKategoriItem' => $kategoriPakaian->idKategoriItem,
            'jumlahKategori' => $pesanan->pakaian,
        ]);

        return redirect()->back()
            ->with('success', 'Verifikasi pemesanan berhasil dilakukan.');
    }
}
