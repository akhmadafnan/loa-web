@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container">
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 shadow-sm">
            <div class="text-center mb-5">
                <div class="feature bg-success bg-gradient text-white rounded-3 mb-3">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" fill="currentColor" class="bi bi-qr-code-scan" viewBox="0 0 16 16">
                        <path d="M0 .5A.5.5 0 0 1 .5 0h3a.5.5 0 0 1 0 1H1v2.5a.5.5 0 0 1-1 0zm12 0a.5.5 0 0 1 .5-.5h3a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-1 0V1h-2.5a.5.5 0 0 1-.5-.5M.5 12a.5.5 0 0 1 .5.5V15h2.5a.5.5 0 0 1 0 1h-3a.5.5 0 0 1-.5-.5v-3a.5.5 0 0 1 .5-.5m15 0a.5.5 0 0 1 .5.5v3a.5.5 0 0 1-.5.5h-3a.5.5 0 0 1 0-1H15v-2.5a.5.5 0 0 1 .5-.5M4 4h1v1H4z" />
                        <path d="M7 2H2v5h5zM3 3h3v3H3zm2 8H4v1h1z" />
                        <path d="M7 9H2v5h5zm-4 1h3v3H3zm8-6h1v1h-1z" />
                        <path d="M9 2h5v5H9zm1 1v3h3V3zM8 8v2h1v1H8v1h2v-2h1v2h1v-1h2v-1h-3V8zm2 2H9V9h1zm4 2h-1v1h-2v1h3zm-4 2v-1H8v1z" />
                        <path d="M12 9h2V8h-2z" />
                    </svg>
                </div>
                <h1 class="fw-bolder">Verification Letter of Acceptance (LOA)</h1>
            </div>

            @if($status === 'not_found')
            <div class="alert alert-danger text-center">
                <h4><i class="bi bi-x-circle-fill text-danger"></i> Unverified</h4>
                <p>No Reg tidak ditemukan.</p>
            </div>
            @else
            <div class="alert alert-success text-center">
                <h4><i class="bi bi-patch-check-fill text-success"></i> Verified</h4>
            </div>

            <table class="table table-bordered">
                <tr>
                    <th>No Reg</th>
                    <td>{{ $loa->registration_number }}</td>
                </tr>
                <tr>
                    <th>Letter Number</th>
                    <td>{{ $loa->letter_number }}</td>
                </tr>
                <tr>
                    <th>ID Article</th>
                    <td>{{ $loa->id_article }}</td>
                </tr>
                <tr>
                    <th>Title</th>
                    <td>{{ $loa->article_title }}</td>
                </tr>
                <tr>
                    <th>Author</th>
                    <td>{{ $loa->article_author }}</td>
                </tr>
                <tr>
                    <th>Journal</th>
                    <td>{{ $loa->journal->name_journals ?? '-' }}</td>
                </tr>
                <tr>
                    <th>Issue</th>
                    <td>Vol.{{ $loa->volume }} No.{{ $loa->number }} {{ $loa->month }} {{ $loa->year }}</td>
                </tr>
            </table>

            @if($loa->link_journal)
            <a href="{{ $loa->link_journal }}" target="_blank" class="btn btn-success mt-3">
                <i class="bi bi-box-arrow-up-right"></i> Kunjungi Artikel
            </a>
            @endif
            <!-- QR Code -->
            <div class="text-center mt-3">
                <p><strong>Scan untuk verifikasi:</strong></p>
                {!! QrCode::size(120)->generate(url('/loa/scan/' . $loa->registration_number)) !!}
            </div>
            @endif
        </div>
    </div>
</section>
@endsection