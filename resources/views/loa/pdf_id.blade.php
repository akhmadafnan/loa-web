<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: DejaVu Sans, sans-serif;
            font-size: 12pt;
        }

        .center {
            text-align: center;
        }

        .signature {
            margin-top: 50px;
        }
    </style>
</head>

<body>
    <div class="center">
        <h3>SURAT KETERANGAN PUBLIKASI ARTIKEL JURNAL</h3>
        <h4><i>Letter of Acceptance (LoA)</i></h4>
        <p>Nomor: {{ $loa->letter_number }}</p>
    </div>

    <p>Kepada YTH.<br>
        {{ $loa->article_author }}
    </p>

    <p>Terimakasih telah mengirimkan artikel dengan judul:</p>
    <p><b>"{{ $loa->article_title }}"</b></p>

    <p>Berdasarkan hasil review dan keputusan tim editor, maka artikel tersebut dinyatakan
        <b>DITERIMA</b> untuk dipublikasikan pada jurnal <b>{{ $loa->journal->name_journals }}</b>
        Volume {{ $loa->volume }} Nomor {{ $loa->number }} bulan {{ $loa->month }} {{ $loa->year }}.
    </p>

    <p>No Reg: {{ $loa->registration_number }}</p>

    <!-- QR Code -->
    <div class="center">
        {!! QrCode::size(100)->generate(url('/loa/scan/' . $loa->registration_number)) !!}
        <p>Scan untuk verifikasi</p>
    </div>

    <div class="signature">
        <p>Kisaran, {{ \Carbon\Carbon::now()->format('d F Y') }}<br>
            Editor In Chief</p>

        @if($loa->journal->ttd)
        <img src="{{ public_path('storage/' . $loa->journal->ttd) }}" height="60">
        @endif

        <p><b>{{ $loa->journal->editor_name }}</b></p>
    </div>
</body>

</html>