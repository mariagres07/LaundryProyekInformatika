<!DOCTYPE html>
<html lang="en">

@extends('Pelanggan.layoutPelanggan')

@section('content')
<div class="container mt-4">

    <!-- Judul Halaman -->
    <h2 class="text-center mb-4 fw-bold">Detail Pengaduan</h2>

    <!-- Tombol Kembali -->
    <a href="{{ route('pelanggan.pengaduan.riwayat') }}" class="btn btn-secondary mb-3">
        ← Kembali
    </a>

    <div class="card shadow-sm border-0">
        <div class="card-body">

            <!-- Judul Pengaduan -->
            <h4 class="fw-bold">{{ $pengaduan->judulPengaduan }}</h4>

            <!-- Informasi Utama -->
            <div class="mt-3">

                <p class="mb-1">
                    <strong>Tanggal Pengaduan:</strong>
                    {{ $pengaduan->tanggalPengaduan }}
                </p>

                <p class="mb-1">
                    <strong>ID Pesanan:</strong>
                    {{ $pengaduan->idPesanan }}
                </p>

                <p class="mb-2">
                    <strong>Status:</strong>
                    @if ($pengaduan->statusPengaduan == 'Belum Ditanggapi')
                        <span class="badge bg-warning text-dark">Belum Ditanggapi</span>
                    @elseif ($pengaduan->statusPengaduan == 'Diproses')
                        <span class="badge bg-primary">Diproses</span>
                    @else
                        <span class="badge bg-success">Selesai</span>
                    @endif
                </p>
            </div>

            <hr>

            <!-- Deskripsi -->
            <h6 class="fw-bold">Deskripsi Pengaduan:</h6>
            <p>{{ $pengaduan->deskripsi }}</p>

            <!-- Media -->
            <h6 class="fw-bold">Lampiran Media:</h6>
            <img src="{{ asset('storage/' . $pengaduan->media) }}"
                 class="img-fluid rounded border"
                 style="max-height: 320px; object-fit: contain;">

            <!-- Tanggapan -->
            @if ($pengaduan->tanggapanPengaduan)
                <div class="alert alert-info mt-4">
                    <strong>Tanggapan Petugas:</strong><br>
                    {{ $pengaduan->tanggapanPengaduan }}
                </div>
            @endif

        </div>
    </div>

</div>
@endsection
