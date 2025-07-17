@extends('layouts.backend')

@section('isi')
<!-- Bread crumb and right sidebar toggle -->
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-truncate text-dark font-weight-medium mb-1">Data Permintaan LOA</h3>
            <div class="d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb m-0 p-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                        <li class="breadcrumb-item text-muted active" aria-current="page">LOA Request</li>
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

                    @if (session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                    @endif

                    <div class="table-responsive">
                        <table id="multi_col_order" class="table border table-striped table-bordered text-nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Reg.</th>
                                    <th>Artikel</th>
                                    <th>Dibuat</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @if ($requests->count())
                                @foreach ($requests as $i => $req)
                                <tr>
                                    <td>{{ $loop->iteration + ($requests->currentPage() - 1) * $requests->perPage() }}</td>
                                    <td>{{ $req->registration_number }}</td>
                                    <td class="text-wrap text-break" style="max-width: 300px;">
                                        <strong class="text-primary">{{ $req->article_title }}</strong><br>
                                        <strong>ID Article:</strong> {{ $req->id_article }}<br>
                                        <strong>Author:</strong> {{ $req->article_author }}<br>
                                        <strong>Issue:</strong> Vol.{{ $req->volume }} No.{{ $req->number }} {{ $req->month }} {{ $req->year }}<br>
                                        <strong>Journal:</strong> {{ $req->journal->name_journals ?? '-' }}<br>
                                    </td>
                                    <td>{{ $req->created_at->format('d-m-Y') }}</td>
                                    <td>
                                        <form action="{{ route('admin.loarequests.approve', $req->id) }}" method="POST" style="display:inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm" onclick="return confirm('Setujui permintaan ini?')">Approve</button>
                                        </form>

                                        <form action="{{ route('admin.loarequests.reject', $req->id) }}" method="POST" style="display:inline;">
                                            @csrf @method('DELETE')
                                            <button class="btn btn-danger btn-sm" onclick="return confirm('Tolak dan hapus permintaan ini?')">Reject</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="5" class="text-center text-muted">Belum ada permintaan LOA.</td>
                                </tr>
                                @endif
                            </tbody>
                        </table>
                    </div>
                    {{ $requests->links() }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection