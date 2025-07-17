@extends('layouts.backend')

@section('isi')
<!-- Breadcrumb -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data LOA Disetujui</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item">
                            <a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a>
                        </li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">LOA</li>
                    </ol>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Konten -->
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">

                    <!-- Notifikasi -->
                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <!-- Tabel -->
                    <div class="table-responsive">
                        <table id="multi_col_order" class="table table-bordered table-striped text-nowrap w-100">
                            <thead>
                                <tr>
                                    <th class="text-center" style="width: 5%;">No</th>
                                    <th class="text-center">No Registrasi</th>
                                    <th class="text-center">Judul Artikel</th>
                                    <th class="text-center">Tanggal Disetujui</th>
                                    <th class="text-center">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($loas as $req)
                                <tr>
                                    <td>{{ $loop->iteration + ($loas->currentPage() - 1) * $loas->perPage() }}</td>
                                    <td style="max-width: 1%;">{{ $req->registration_number }}</td>
                                    <td class="text-wrap text-break" style="max-width: 350px;">
                                        <strong class="text-primary">{{ $req->article_title }}</strong><br>
                                        <strong>ID Article:</strong> {{ $req->id_article }}<br>
                                        <strong>Author:</strong> {{ $req->article_author }}<br>
                                        <strong>Issue:</strong> Vol.{{ $req->volume }} No.{{ $req->number }} {{ $req->month }} {{ $req->year }}<br>
                                        <strong>Journal:</strong> {{ $req->journal->name_journals ?? '-' }}
                                    </td>
                                    <td class="text-center">{{ $req->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <a href="{{ route('admin.loa.view', $req->id) }}" class="btn btn-success btn-sm" title="lihat"><i class="fas fa-eye"></i></a>

                                        <a href="{{ route('admin.loa.edit', $req->id) }}" class="btn btn-warning btn-sm" title="Edit"><i class="fas fa-pencil-alt"></i></a>

                                        <form action="{{ route('admin.loa.destroy', $req->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Yakin ingin menghapus LOA ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger btn-sm" title="Hapus"><i class="fas fa-trash"></i></button>
                                        </form>

                                        <!-- Tombol Cetak -->
                                        <div class="btn-group">
                                            <button class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown">
                                                <i class="fas fa-print"></i>
                                            </button>
                                            <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.loa.print', ['registration_number' => $req->registration_number, 'lang' => 'id']) }}"
                                                        target="_blank">
                                                        Indonesia
                                                    </a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item"
                                                        href="{{ route('admin.loa.print', ['registration_number' => $req->registration_number, 'lang' => 'en']) }}"
                                                        target="_blank">
                                                        Inggris
                                                    </a>
                                                </li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @empty
                                <tr>
                                    <td colspan="5" class="text-center">Belum ada data LOA yang disetujui.</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </div>

                    <!-- Pagination -->
                    <div class="mt-3">
                        {{ $loas->links() }}
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>
@endsection