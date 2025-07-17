<!DOCTYPE html>
<html lang="{{ $lang }}">

<head>
    <meta charset="UTF-8">
    <style>
        body {
            font-family: Cambria, 'Times New Roman', serif;
            font-size: 15px;
            margin: 0cm 1.5cm 1cm 1cm;
        }

        .header {
            text-align: center;
            /* margin-bottom: 10px; */
        }

        .letter-number {
            text-align: center;
            margin-bottom: 20px;
        }

        .content {
            text-align: justify;
            line-height: 1.7;
        }

        .signature {
            position: absolute;
            bottom: 80px;
            right: 80px;
            text-align: center;
        }

        .qr {
            position: absolute;
            bottom: 80px;
            left: 80px;
        }
    </style>
</head>

<body>

    <!-- Header (Logo atau nama jurnal) -->
    <div class="header">
        <img src="{{ public_path('storage/' . $loa->journal->logo) }}" height="70">
        <h2>{{ $loa->journal->name_journals }}</h2>
        <p style="font-size: 5px;">e-Issn: {{ $loa->journal->e_issn }} | e-Issn: {{ $loa->journal->p_issn }}</p>
        <p></p>
    </div>

    <!-- Nomor Surat -->
    <div class="letter-number">
        Nomor: {{ $loa->letter_number }}
    </div>

    <!-- Isi Surat -->
    <div class="content">
        @if ($lang === 'id')
        <p>Kepada Yth:<br>
            <strong>{{ $loa->article_author }}</strong>
        </p>

        <p>Terimakasih telah mengirimkan artikel terbaik anda untuk diterbitkan pada <strong>{{ $loa->journal->name_journals }}</strong> dengan judul:</p>
        <h3 style="text-align: center;"><b>"{{ $loa->article_title }}"</b></h3>

        <p>Berdasarkan hasil review dan keputusan tim editor, maka artikel tersebut dinyatakan
            <b>DITERIMA</b> untuk dipublikasikan pada jurnal <b>{{ $loa->journal->name_journals }}</b> edisi
            <b>Volume {{ $loa->volume }} Nomor {{ $loa->number }}</b> bulan <b>{{ $loa->month }} {{ $loa->year }}.</b>
        </p>

        <p>Demikian surat keterangan ini kami sampaikan untuk dipergunakan sebagaimana mestinya, kami ucapkan terimakasih.</p>

        <p><strong>No Reg : {{ $loa->registration_number }}</strong></p>


        @else
        <p>Dear Author,</p>
        <p>We hereby confirm that the manuscript entitled:</p>
        <p><strong>“{{ $loa->article_title }}”</strong></p>
        <p>written by:</p>
        <p><strong>{{ $loa->article_author }}</strong></p>
        <p>has been accepted for publication in the <strong>{{ $loa->journal->name_journals }}</strong>, Volume {{ $loa->volume }}, Issue {{ $loa->number }}, {{ $loa->month }} {{ $loa->year }} edition.</p>
        <p>This letter serves as an official acceptance confirmation and may be used for academic or administrative purposes.</p>
        <p>Thank you for your contribution and cooperation.</p>
        @endif
    </div>

    <!-- TTD -->
    <div class="signature">
        Lumajang, {{ $loa->journal->date_timestamp_set }}<br>
        Editor in Chief<br>
        @if ($loa->journal->ttd)
        <img src="{{ public_path('storage/' . $loa->journal->ttd) }}" height="80"><br>
        @endif
        <strong>{{ $loa->journal->editor_name }}</strong>
    </div>

    <!-- QR Code -->
    <div class="qr">
        {!! QrCode::size(100)->generate(url('/loa/scan/' . $loa->registration_number)) !!}
    </div>

</body>

</html>