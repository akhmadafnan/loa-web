<div class="card border-success shadow">
    <div class="card-header bg-success text-white"><i class="bi bi-patch-check-fill"></i> Verified</div>
    <div class="card-body">
        <img src="{{ asset('img/verified.png') }}" alt="verified" style="width: 120px;" class="d-block mx-auto mb-4">
        <table class="table table-bordered">
            <tr>
                <th>No Reg</th>
                <td>{{ $loa->registration_number }}</td>
            </tr>
            <tr>
                <th>Letter Number</th>
                <td>{{ $loa->letter_number ?? '-' }}</td>
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
        <a href="{{ $loa->link_journal }}" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-box-arrow-up-right"></i> Visit Artikel</a>
        @endif

        <div class="text-center mt-3">
            <p><strong>Scan untuk verifikasi:</strong></p>
            <img src="https://api.qrserver.com/v1/create-qr-code/?size=120x120&data={{ url('/loa/scan/' . $loa->registration_number) }}" alt="QR Code">
        </div>
    </div>
</div>