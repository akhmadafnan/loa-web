@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-success bg-gradient text-white rounded-3 mb-3"><i class="bi bi-patch-check-fill"></i></div>
                <h1 class="fw-bolder">Formulir LOA Anda Berhasil Dikirimkan</h1>
                <p class="lead fw-normal text-muted mb-0">Nomor Registrasi Anda:</p>
                <h4>{{ $regNumber }}</h4>
                <p>Selanjutnya Silahkan Tunggu atau Konfirmasi ke Admin agar LOA anda di Approve!</p>
            </div>

            <div class="d-grid mt-3">
                <a href="/req-loa" class="btn btn-success btn-block">Kembali</a>
            </div>
        </div>
    </div>
</section>
@endsection