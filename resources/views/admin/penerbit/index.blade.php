@extends('layouts.backend')

@section('isi')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Penerbit</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Penerbit</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Container -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <a href="{{ route('admin.penerbits.create') }}" class="btn btn-sm btn-primary mb-3">Tambah Penerbit</a>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Penerbit</th>
                                    <th>No. HP</th>
                                    <th>Logo</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penerbits as $penerbit)
                                <tr>
                                    <td>{{ $loop->iteration + ($penerbits->currentPage() - 1) * $penerbits->perPage() }}</td>
                                    <td>{{ $penerbit->nama }}</td>
                                    <td>{{ $penerbit->no_hp }}</td>
                                    <td>
                                        @if($penerbit->logo)
                                        <img src="{{ asset('storage/' . $penerbit->logo) }}" alt="Logo" width="60">
                                        @else
                                        <span class="text-muted">Tidak ada logo</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.penerbits.edit', $penerbit) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.penerbits.destroy', $penerbit) }}" method="POST" style="display:inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>

                    {{ $penerbits->links() }}

                </div>
            </div>
        </div>
    </div>
</div>
@endsection