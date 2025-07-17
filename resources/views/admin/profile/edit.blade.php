@extends('layouts.backend')

@section('isi')

@php
use Illuminate\Support\Str;
@endphp

<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Edit Profile</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Edit Profile</li>
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

                    @if (session('status') === 'profile-updated')
                    <div class="alert alert-success mt-2">Profil berhasil diperbarui.</div>
                    @endif

                    <form action="{{ route('profile.update', ['name' => Str::slug($user->name)]) }}" method="POST" enctype="multipart/form-data">

                        @csrf
                        @method('PATCH')
                        <div class="form-body">
                            <label class="form-label">NAMA LENGKAP</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="text" name="name" class="form-control" id="name"
                                            value="{{ old('name', $user->name) }}" required>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">EMAIL</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="email" name="email" class="form-control" id="email"
                                            value="{{ old('email', $user->email) }}" required>
                                    </div>
                                </div>
                            </div>

                            <label class="form-label">PHOTO PROFIL (jika ingin ganti)</label>
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="form-group mb-3">
                                        <input type="file" name="avatar" class="form-control" accept="image/*">
                                        @if ($user->avatar)
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" width="100" class="rounded-circle mt-2">
                                        @else
                                        <p class="text-muted">Belum ada foto.</p>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Simpan Perubahan</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
