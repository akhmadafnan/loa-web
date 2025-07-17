@extends('layouts.backend')

@section('title', 'Edit Data Jurnal | Manajemen Letter of Acceptance')
@section('isi')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Data Jurnal</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.journals.index') }}" class="text-muted">Jurnal</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Edit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    @if ($errors->any())
                    <div class="alert alert-danger">
                        <strong>Terjadi kesalahan!</strong>
                        <ul class="mb-0 mt-2">
                            @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                    @endif

                    @if (session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form action="{{ route('admin.journals.update', $journal->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-body">
                            <label class="form-label">NAMA JURNAL</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="name_journals" class="form-control" placeholder="nama jurnal" value="{{ old('name_journals', $journal->name_journals) }}">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">KODE JURNAL</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="kode_jurnal" class="form-control" placeholder="nama jurnal" value="{{ old('kode_jurnal', $journal->kode_jurnal) }}">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">E-ISSN</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="e_issn" class="form-control" placeholder="e-issn" value="{{ old('e_issn', $journal->e_issn) }}">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">P-ISSN</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="p_issn" class="form-control" placeholder="p-issn" value="{{ old('p_issn', $journal->p_issn) }}">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">LINK JURNAL</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="website_url" class="form-control" placeholder="link jurnal" value="{{ old('website_url', $journal->website_url) }}">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">EDITOR IN CHIEF</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="editor_name" class="form-control" placeholder="nama editor in chief" value="{{ old('editor_name', $journal->editor_name) }}">
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">LOGO JURNAL</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="file" name="logo" class="form-control" accept="image/*">
                                        @if ($journal->logo)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $journal->logo) }}" alt="Logo" width="120">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">TANDA TANGAN</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="file" name="ttd" class="form-control" accept="image/*">
                                        @if ($journal->ttd)
                                        <div class="mt-2">
                                            <img src="{{ asset('storage/' . $journal->ttd) }}" alt="ttd" width="120">
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-actions">
                            <div class="text">
                                <button type="submit" class="btn btn-primary">Update</button>
                                <a href="{{ route('admin.journals.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
