<!DOCTYPE html>
<html lang="id">

<head>
    <meta charset="UTF-8">
    <title>Letter of Acceptance</title>
    <style>
        @page {
            margin: 1.5cm 1.3cm 1.3cm 1.3cm;
            /* margin: 1.5cm; */
        }

        body {
            font-family: Cambria, 'Times New Roman', serif;
            font-size: 12pt;
            line-height: 1.6;
            color: #000;
        }

        .header {
            text-align: center;
            padding-bottom: 3px;
            margin-bottom: 20px;
            font-family: Arial, sans-serif;
        }

        .header h2 {
            margin-bottom: 0px;
        }

        .header p {
            text-align: center;
            /* padding-bottom: 10px; */
            margin-bottom: 5px;
            margin-top: 0px;
        }

        .content {
            text-align: justify;
        }

        .signature {
            text-align: right;
        }

        .footer {
            position: fixed;
            bottom: 1cm;
            font-size: 10pt;
            text-align: center;
        }

        .qr-code {
            position: absolute;
            bottom: 100px;
            left: 20px;
        }

        .logo-ttd {
            width: 150px;
        }

        .info {
            font-size: 11pt;
            text-align: center;
        }

        .no-reg {
            font-weight: bold;
            font-size: 12pt;
        }
    </style>
</head>

<body>

    <div style="width: 100%; display: table; margin-bottom: 20px; font-family: Arial, sans-serif;">
        <!-- Kolom Kiri: Logo Penerbit -->
        <div style="display: table-cell; width: 10%; text-align: center; vertical-align: middle;">
            <img src="{{ public_path('storage/' . $loa->journal->penerbit->logo) }}" alt="Logo Kiri" height="70">
        </div>

        <!-- Kolom Tengah: Nama Jurnal dan Info -->
        <div style="display: table-cell; width: 80%; text-align: center; vertical-align: middle;">
            <h2 style="margin: 0px 0;">{{ $loa->journal->name_journals }}</h2>
            <p style="font-size: 12px; margin: 0px 0;">
                HP: +62 856-4618-9758 | E-ISSN: {{ $loa->journal->e_issn }} ; P-ISSN: {{ $loa->journal->p_issn }}
            </p>
        </div>

        <!-- Kolom Kanan: Logo Jurnal -->
        <div style="display: table-cell; width: 10%; text-align: center; vertical-align: middle;">
            <img src="{{ public_path('storage/' . $loa->journal->logo) }}" alt="Logo Kanan" height="70">
        </div>
    </div>
    <hr style="border: 2px solid black; margin: 10px 0;">




    <!-- Judul -->
    <h3 style="text-align: center; text-transform: uppercase; margin-bottom: 4px;">Surat Keterangan Publikasi Artikel Jurnal</h3>
    <h2 style="text-align: center; font-style: italic; text-decoration: underline; margin-top: 0;">Letter of Acceptance (LoA)</h2>


    <!-- Nomor Surat -->
    <p style="text-align: center; margin-top: 0;">Nomor : {{ $loa->letter_number }}</p>

    <!-- Isi -->
    <div class=" content">
        <p>Kepada Yth.<br>
            <b>{{ $loa->article_author }}</b>
        </p>

        <p>Terima kasih telah mengirimkan artikel terbaik Anda untuk diterbitkan pada
            <strong>{{ $loa->journal->name_journals }}</strong> dengan judul:
        </p>

        <p style="font-size: 20px; text-align: center;"><strong>"{{ $loa->article_title }}"</strong></p>

        <p>Berdasarkan hasil review dan keputusan tim editor, maka artikel tersebut dinyatakan
            <strong>DITERIMA</strong> untuk dipublikasikan pada <b>{{ $loa->journal->name_journals }}</b> edisi <b>Volume {{ $loa->volume }} Nomor {{ $loa->number }}, {{ $loa->month }} {{ $loa->year }}.</b>
        </p>

        <p>Demikian surat keterangan ini kami sampaikan untuk dipergunakan sebagaimana mestinya. Kami ucapkan terima kasih.</p>
    </div>

    <!-- Nomor Reg -->
    <div class="no-reg">
        No Reg : {{ $loa->registration_number }}
    </div>


    <!-- Kontainer QR dan TTD -->
    <div>
        <table style="width: 100%; margin-top: 80px;">
            <!-- Row 1: QR Code kiri, kosong kanan -->
            <tr>
                <td style="width: 50%; text-align: left;">
                    <table>
                        <tr>
                            <!-- QR Code -->
                            <td style="padding-right: 10px;">
                                <img src="{{ $qrImage }}" width="120" alt="QR Code">

                                <p style="margin: 4px 0 0; font-weight: bold;font-size: 11pt; text-align: center;">
                                    {{ $loa->registration_number }}
                                </p>
                            </td>

                            <!-- Teks keterangan -->
                            <td style="vertical-align: top; font-size: 10pt; line-height: 1.3;">
                                <p style="margin: 0;">
                                    Keaslian LOA Dapat<br>
                                    Diperiksa Dengan<br>
                                    Memindai QR Code<br>
                                    Disamping!
                                </p>
                            </td>
                        </tr>
                    </table>
                </td>


                <td colspan="2" style="height: 40px;"></td>
                <td style="text-align: left; font-size: 12pt;">
                    <p style="margin: 4px 0; line-height: 2; ">
                        Lumajang, {{ \Carbon\Carbon::parse($loa->created_at)->translatedFormat('d F Y') }}<br>
                        <strong>Editor In Chief</strong>
                    </p>

                    @if($loa->journal->ttd)
                    <img src="{{ public_path('storage/' . $loa->journal->ttd) }}" style="max-height: 75px;">
                    @endif

                    <p style="margin: 4px 0; line-height: 1;"><strong>{{ $loa->journal->editor_name }}</strong></p>
                </td>
            </tr>
        </table>
    </div>


    <!-- Garis pemisah -->
    <hr style="margin-top: 10px;">

    <!-- Footer Penerbit -->
    <div style="text-align: left; font-size: 10pt;">
        <p style="margin: 4px 0; line-height: 1; font-size: 13px; font-family: Arial, sans-serif;">
            Penerbit :<br>
            <b style="font-size: 18px;">{{ $loa->journal->penerbit->nama }}</b><br>
            {{ $loa->journal->penerbit->alamat }}<br>
            Hub. {{ $loa->journal->penerbit->no_hp }}
        </p>
    </div>

</body>

</html>
