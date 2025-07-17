@extends('layouts.backend')

@section('title', 'Edit Data Penerbit | Manajemen Letter of Acceptance')
@section('isi')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Data Penerbit</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('admin.penerbits.index') }}" class="text-muted">Penerbit</a></li>
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

                    <form action="{{ route('admin.penerbits.update', $penerbit) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="form-body">

                            <label class="form-label">NAMA PENERBIT</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="nama" class="form-control" value="{{ old('nama', $penerbit->nama) }}" required>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">ALAMAT</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <textarea name="alamat" class="form-control" rows="3" required>{{ old('alamat', $penerbit->alamat) }}</textarea>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">NO. HP</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="no_hp" class="form-control" value="{{ old('no_hp', $penerbit->no_hp) }}" required>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">LOGO PENERBIT (jika ingin ganti)</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="file" name="logo" class="form-control" accept="image/*">
                                        @if ($penerbit->logo)
                                        <p class="mt-2">
                                            <strong>Logo sekarang:</strong><br>
                                            <img src="{{ asset('storage/' . $penerbit->logo) }}" alt="Logo" width="80">
                                        </p>
                                        @endif
                                    </div>
                                </div>
                            </div>

                        </div>
                        <br><br>
                        <div class="form-actions">
                            <div class="text">
                                <button type="submit" class="btn btn-success">Update</button>
                                <a href="{{ route('admin.penerbits.index') }}" class="btn btn-warning">Kembali</a>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
