@extends('layouts.backend')

@section('isi')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Daftar Jurnal</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">Jurnal</li>
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
                    {{-- <h4 class="card-title">Multi-column ordering</h4> --}}
                    <a href="{{ route('admin.journals.create') }}" class="btn btn-sm btn-primary mb-3">Tambah Journal</a>

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>Nama Jurnal</th>
                                    <th>Kode Jurnal</th>
                                    <th>E-ISSN</th>
                                    <th>P-ISSN</th>
                                    <th>Nama Editor</th>
                                    <th>Logo</th>
                                    <th>Ttd</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($journals as $journal)
                                <tr>
                                    <td>{{ $loop->iteration + ($journals->currentPage() - 1) * $journals->perPage() }}</td>
                                    <td>{{ $journal->name_journals }}</td>
                                    <td>{{ $journal->kode_jurnal }}</td>
                                    <td>{{ $journal->e_issn }}</td>
                                    <td>{{ $journal->p_issn }}</td>
                                    <td>{{ $journal->editor_name }}</td>
                                    {{-- <td>{{ $journal->logo }}</td> --}}
                                    <td>
                                        @if($journal->logo)
                                        <img src="{{ asset('storage/' . $journal->logo) }}" alt="Logo" width="80">
                                        @else
                                        <span class="text-muted">Tidak ada logo</span>
                                        @endif
                                    </td>
                                    <td>
                                        @if($journal->ttd)
                                        <img src="{{ asset('storage/' . $journal->ttd) }}" alt="ttd" width="80">
                                        @else
                                        <span class="text-muted">Tidak ada ttd</span>
                                        @endif
                                    </td>
                                    <td>
                                        <a href="{{ route('admin.journals.edit', $journal) }}" class="btn btn-warning btn-sm">Edit</a>
                                        <form action="{{ route('admin.journals.destroy', $journal) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Yakin hapus?')">Hapus</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    {{ $journals->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection