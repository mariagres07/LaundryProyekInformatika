@extends('layouts.app')

@section('content')
<div class="container mt-5 text-center">
    <h3 class="text-success fw-bold">Pembayaran Berhasil!</h3>
    <p>Terima kasih, pembayaran kamu telah diproses oleh Midtrans.</p>
    <a href="{{ route('pesanLaundry.index') }}" class="btn btn-primary mt-3">Kembali ke Pesanan</a>
</div>
@endsection
</html>