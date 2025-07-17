<!DOCTYPE html>
<html>

<head>
    <title>Cetak LOA</title>
</head>

<body>
    <h2>Letter of Acceptance</h2>
    <p>No. Registrasi: {{ $loa->registration_number }}</p>
    <p>Judul: {{ $loa->article_title }}</p>
    <p>Penulis: {{ $loa->article_author }}</p>
    <p>Volume: {{ $loa->volume }}, No: {{ $loa->number }}, {{ $loa->month }} {{ $loa->year }}</p>
    <p>Jurnal: {{ $loa->journal->name_journals ?? '-' }}</p>
</body>

</html>