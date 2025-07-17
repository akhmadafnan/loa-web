@extends('layouts.frontend')

@section('content')
<section class="py-5">
    <div class="container">
        <!-- Verifikasi LOA -->
        <div class="bg-light rounded-3 py-5 px-4 px-md-5 mb-5 shadow-sm">
            <div class="text-center mb-5">
                <div class="feature bg-success bg-gradient text-white rounded-3 mb-3">
                    <i class="bi bi-patch-check-fill fs-3"></i>
                </div>
                <h1 class="fw-bolder">Verification Letter of Acceptance (LOA)</h1>
                <p class="lead fw-normal text-muted mb-0">
                    Please enter the Reg. No listed on the LOA to check the authenticity of your LOA!
                </p>
            </div>
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="input-group input-group-lg mb-4">
                        <input name="no_reg" id="no_reg" maxlength="17" class="form-control form-control-lg " placeholder="No Reg.">
                        <button type="button" class="btn btn-success" onclick="Verifikasi()">
                            <i class="bi bi-check-circle-fill"></i> Verification
                        </button>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="Tabel"></div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SweetAlert JS -->
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

<!-- AJAX Script -->
<script>
    // Tambahkan ini di awal
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        }
    });

    function Verifikasi() {
        let no_reg = $('#no_reg').val();
        if (no_reg === "") {
            swal("Oops", "No Reg Belum Anda Isi !", "error");
            return;
        }

        $.ajax({
            type: "POST",
            url: "{{ route('loa.verifikasi.check') }}",
            data: {
                no_reg: no_reg,
            },
            dataType: "json",
            success: function(response) {
                if (response.data) {
                    $('.Tabel').html(response.data);
                }
            },
            error: function(xhr) {
                console.log(xhr.responseText); // debug
                swal("Error", "Terjadi kesalahan saat memverifikasi.", "error");
            }
        });
    }
</script>
@endsection