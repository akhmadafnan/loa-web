@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container px-5">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-file-earmark-text"></i></div>
                <h1 class="fw-bolder">LOA Request Form</h1>
                <p class="lead fw-normal text-muted mb-0">Fill out this form according to your article data!</p>
            </div>

            <div class="row gx-5 justify-content-center">
                <form action="{{ route('loa.store') }}" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>ID Article</label>
                                <input type="number" min="1" name="id_article" class="form-control" required>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Volume</label>
                                <input type="number" name="volume" class="form-control" required>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Number</label>
                                <input type="number" name="number" class="form-control" required>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-4">
                            <div class="form-group">
                                <label>Month</label>
                                <select name="month" class="form-select" required>
                                    <option value="">-- Pilih Bulan --</option>
                                    @foreach (['Januari','Februari','Maret','April','Mei','Juni','Juli','Agustus','September','Oktober','November','Desember'] as $bulan)
                                    <option value="{{ $bulan }}">{{ $bulan }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-2">
                            <div class="form-group">
                                <label>Year</label>
                                <select type="number" name="year" class="form-control" required>
                                    @for ($y = now()->year + 2; $y >= 2000; $y--)
                                    <option value="{{ $y }}" {{ $y == now()->year ? 'selected' : '' }}>{{ $y }}</option>
                                    @endfor
                                </select>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Article Title</label>
                                <input class="form-control" name="article_title" type="text" required>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Author</label>
                                <input class="form-control" name="article_author" type="text" required>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="form-group">
                                <label>Journal</label>
                                <select name="journal_id" class="form-select" required>
                                    <option value="">--Pilih Jurnal--</option>
                                    @foreach ($journals as $j)
                                    <option value="{{ $j->id }}">{{ $j->name_journals }}</option>
                                    @endforeach
                                </select>
                                <p class="text-danger"></p>
                            </div>
                        </div>

                        <div class="d-grid"><br>
                            <button class="btn btn-primary" type="submit">Submit</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
@endsection