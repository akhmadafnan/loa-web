@extends('layouts.frontend')

@section('content')
    <header class="bg-dark py-5">
        <div class="container px-5">
            <div class="row gx-5 align-items-center justify-content-center">
                <div class="col-lg-8 col-xl-7 col-xxl-6">
                    <div class="my-5 text-center text-xl-start">
                        <h1 class="display-5 fw-bolder text-white mb-2">
                            Selamat Datang
                        </h1>
                        <p class="lead fw-normal text-white-50 mb-4">
                            Website Letter of Acceptance Ini Akan Memberikan Kemudahan
                            Kepada Penulis Untuk Melakukan Permintaan LOA Maupun Download
                            Dan Cetak LOA
                        </p>
                        <div class="d-grid gap-3 d-sm-flex justify-content-sm-center justify-content-xl-start">
                            <a class="btn btn-primary btn-lg px-4 me-sm-3" href="/mintaloa">
                                Minta LOA
                            </a>
                            <a class="btn btn-outline-light btn-lg px-4" href="/loa">
                                Cari LOA
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-xxl-6 d-none d-xl-block text-center">
                    <img class="img-fluid rounded-3 my-5" src="https://loa.padangtekno.com//gambar.png" alt="..." />
                </div>
            </div>
        </div>
    </header>

    <!-- Features section-->
    <section class="py-5" id="features">
        <div class="container px-5 my-5">
            <div class="row gx-5">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-sm-4 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-patch-check-fill"></i>
                            </div>
                            <h2 class="h5">Verifikasi LOA</h2>
                            <p class="mb-0">Halaman Untuk Cek Keaslian LOA</p>
                            <br />
                        </div>
                        <div class="col-sm-4 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-search"></i>
                            </div>
                            <h2 class="h5">Cari LOA</h2>
                            <p class="mb-0">Halaman Untuk Mencari Dan Download LOA</p>
                            <br />
                        </div>
                        <div class="col-sm-4 mb-md-0 h-100">
                            <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3">
                                <i class="bi bi-file-earmark-text"></i>
                            </div>
                            <h2 class="h5">Minta LOA</h2>
                            <p class="mb-0">Halaman Untuk Meminta LOA Jika Di Perlukan</p>
                            <br />
                        </div>
                    </div>
                </div>

                <div class="col-xl-12">
                    <div class="card border-0 bg-light mt-xl-5">
                        <div class="card-body p-4 py-lg-5">
                            <div class="d-flex align-items-center justify-content-center">
                                <div class="text-center">
                                    <div class="h6 fw-bolder">Zureka Publish</div>
                                    <p class="text-muted mb-4">
                                        Jl. Alun-alun Timur No. 3, Ditotrunan, Kab. Lumajang, Jawa Timur.
                                        <br />
                                        zurekaofficial@gmail.com
                                        <br />
                                        +62 856-4618-9758
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- End of Features section-->
@endsection