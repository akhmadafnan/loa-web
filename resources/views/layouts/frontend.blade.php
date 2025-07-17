<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />

    <meta name="description"
        content="Website Letter of Acceptance Ini Akan Memberikan Kemudahan Kepada Penulis Untuk Melakukan Permintaan LOA Maupun Download Dan Cetak LOA" />
    <meta name="keywords" content="loa" />
    <meta name="author" content="afnanf.id" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="google-site-verification" content="" />
    <title>LOA Zureka Publish</title>

    <!-- Favicon-->
    <link rel="icon" type="image/x-icon"
        href="{{asset('img/iconic.png')}}" />

    <!-- Bootstrap icons-->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

    <!-- Core theme CSS (includes Bootstrap)-->
    <link href="{{asset('css/core.css')}}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css" />

    <!-- JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js"></script>
</head>

<body class="d-flex flex-column">
    <x-navbar></x-navbar>

    @yield('content')

    <!-- Footer-->
    <x-footer></x-footer>
    <!-- End of Footer-->
</body>

</html>
