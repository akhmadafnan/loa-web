@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container">
        <!-- Contact form-->
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5">
            <div class="text-center mb-5">
                <div class="feature bg-primary bg-gradient text-white rounded-3 mb-3"><i class="bi bi-file-earmark-text"></i></div>
                <h1 class="fw-bolder">Letter of Acceptance (LOA)</h1>
                <p class="lead fw-normal text-muted mb-0">Silahkan Cari Dan Cetak Loa Anda Dibawah Ini</p>
            </div>

            <div class="row">
                <table class="table table-bordered display" id="example" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">No Reg.</th>
                            <th class="text-center">Artikel</th>
                            <th width="150px" class="text-center">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($loas as $loa)
                        <tr>
                            <td class="text-center">{{ $loop->iteration + ($loas->currentPage() - 1) * $loas->perPage() }}</td>
                            <td class="text-center">{{ $loa->registration_number }}</td>
                            <td>
                                <b class="text-primary">{{ $loa->article_title }}</b><br>
                                <b> ID Artikel :</b> {{ $loa->id_article }}<br>
                                <b> Penulis :</b> {{ $loa->article_author }}<br>
                                <b>Edisi :</b> Vol.{{ $loa->volume }} No.{{ $loa->number }} {{ $loa->month }} {{ $loa->year }}<br>
                                <b> Jurnal :</b> {{ $loa->journal->name_journals ?? '-' }}<br>
                            </td>
                            <td class="text-center">
                                <!-- <a href="https://loa.padangtekno.com/Loa/cetak/LOA20241216033559" target="_blank" class="btn btn-primary dropdown-toggle btn-sm" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-printer"></i> Print</a> -->
                                <a class="btn btn-primary btn-sm dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="bi bi-printer"></i> Print
                                </a>
                                <ul class="dropdown-menu">
                                    <li>
                                        <a class="dropdown-item" target="_blank"
                                            href="{{ route('loa.print.public', ['id' => $loa->id, 'lang' => 'id']) }}">Indonesia
                                        </a>
                                    </li>
                                    <li>
                                        <a class="dropdown-item" target="_blank"
                                            href="{{ route('loa.print.public', ['id' => $loa->id, 'lang' => 'en']) }}">English
                                        </a>
                                    </li>
                                </ul>

                                @if ($loa->link_journal) <a href="{{ $loa->link_journal }}" target="_blank" class="btn btn-success btn-sm"><i class="bi bi-eye"></i> Visit</a>
                                @endif
                            </td>
                        </tr>
                        @empty
                        <p class="text-muted">Belum ada LOA yang disetujui.</p>
                        @endforelse

                        <div class="mt-4">
                            {{ $loas->links() }}
                        </div>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</section>

<script>
    new DataTable('#example');
</script>

@endsection