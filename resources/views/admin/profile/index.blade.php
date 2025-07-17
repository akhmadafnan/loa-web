@extends('layouts.backend')

@section('title', 'Data Profile | Manajemen Letter of Acceptance')
@section('isi')
<!-- Breadcrumb -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Pengguna</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Pengguna</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Table Users -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-bordered table-striped text-nowrap">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama</th>
                                    <th>Email</th>
                                    <th>Avatar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($users as $user)
                                <tr>
                                    <td>{{ $loop->iteration + ($users->currentPage() - 1) * $users->perPage() }}</td>
                                    <td>{{ $user->name }}</td>
                                    <td>{{ $user->email }}</td>
                                    <td>
                                        @if($user->avatar)
                                        <img src="{{ asset('storage/avatars/' . $user->avatar) }}" width="60" class="rounded-circle">
                                        @else
                                        <span class="text-muted">Tidak ada foto</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('profile.edit', $user->name) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <!-- Tambahkan aksi hapus jika diperlukan -->
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $users->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection
