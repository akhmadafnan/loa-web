@extends('layouts.backend')

@section('isi')
<div class="page-breadcrumb">
    <div class="row">
        <div class="col-7 align-self-center">
            <h3 class="page-title text-dark font-weight-medium mb-1">Edit LOA</h3>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb m-0 p-0">
                    <li class="breadcrumb-item"><a href="{{ route('dashboard') }}" class="text-muted">Dashboard</a></li>
                    <li class="breadcrumb-item"><a href="{{ route('admin.loas.index') }}" class="text-muted">LOA</a></li>
                    <li class="breadcrumb-item text-muted active" aria-current="page">Edit - {{ $loa->registration_number }}</li>
                </ol>
            </nav>
        </div>
    </div>
</div>

<div class="container-fluid">
    <div class="card">
        <div class="card-body">
            <form method="POST" action="{{ route('admin.loa.update', $loa->id) }}">
                @csrf
                @method('PUT')

                <div class="form-group">
                    <label for="article_title">Judul Artikel</label>
                    <input type="text" name="article_title" class="form-control" value="{{ old('article_title', $loa->article_title) }}" required>
                </div>

                <div class="form-group">
                    <label for="article_author">Penulis Artikel</label>
                    <input type="text" name="article_author" class="form-control" value="{{ old('article_author', $loa->article_author) }}" required>
                </div>

                <div class="form-group">
                    <label for="journal_id">Jurnal</label>
                    <select name="journal_id" class="form-control" required>
                        @foreach ($journals as $journal)
                        <option value="{{ $journal->id }}" {{ $loa->journal_id == $journal->id ? 'selected' : '' }}>
                            {{ $journal->name_journals }}
                        </option>
                        @endforeach
                    </select>
                </div>


                <div class="form-group">
                    <label for="volume">Volume</label>
                    <input type="text" name="volume" class="form-control" value="{{ old('volume', $loa->volume) }}" required>
                </div>

                <div class="form-group">
                    <label for="number">Nomor</label>
                    <input type="text" name="number" class="form-control" value="{{ old('number', $loa->number) }}" required>
                </div>

                <div class="form-group">
                    <label for="month">Bulan</label>
                    <select name="month" class="form-control" required>
                        @foreach(['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                        <option value="{{ $bulan }}" {{ $loa->month == $bulan ? 'selected' : '' }}>{{ $bulan }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="form-group">
                    <label for="year">Tahun</label>
                    <input type="number" name="year" class="form-control" value="{{ old('year', $loa->year) }}" required min="2000" max="{{ now()->year }}">
                </div>

                <div class="form-group">
                    <label for="link_journal">Link Jurnal (opsional)</label>
                    <input type="url" name="link_journal" class="form-control" value="{{ old('link_journal', $loa->link_journal) }}">
                </div>

                <div class="mt-4 d-grid gap-2">
                    <button type="submit" class="btn btn-primary">Update</button>
                    <a href="{{ route('admin.loas.index') }}" class="btn btn-secondary">Kembali</a>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection