@extends('layouts.backend')

@section('title', 'Lihat LOA | Manajemen Letter of Acceptance')
@section('isi')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-dark font-weight-medium mb-1">Detail LOA</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.loas.index') }}" class="text-muted">LOA</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">Lihat - {{ $loa->registration_number }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <h4 class="card-title">Informasi Permintaan LOA</h4>
            <hr>
            <dl class="row">
                <dt class="col-sm-3">Nomor Registrasi</dt>
                <dd class="col-sm-9">{{ $loa->registration_number }}</dd>

                <dt class="col-sm-3">Judul Artikel</dt>
                <dd class="col-sm-9">{{ $loa->article_title }}</dd>

                <dt class="col-sm-3">Author</dt>
                <dd class="col-sm-9">{{ $loa->article_author }}</dd>

                <dt class="col-sm-3">ID Article</dt>
                <dd class="col-sm-9">{{ $loa->id_article }}</dd>

                <dt class="col-sm-3">Volume & Issue</dt>
                <dd class="col-sm-9">Vol.{{ $loa->volume }} No.{{ $loa->number }} {{ $loa->month }} {{ $loa->year }}</dd>

                <dt class="col-sm-3">Nama Jurnal</dt>
                <dd class="col-sm-9">{{ $loa->journal->name_journals ?? '-' }}</dd>

                <dt class="col-sm-3">Tanggal Disetujui</dt>
                <dd class="col-sm-9">{{ $loa->created_at->format('d-m-Y') }}</dd>
            </dl>

            <div class="mt-4 d-grid">
                <a href="{{ route('admin.loas.index') }}" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </div>
</div>
@endsection
