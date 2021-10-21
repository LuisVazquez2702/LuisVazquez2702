
@extends('layouts.app', ['title' => __('Pago con Tarjeta')])

@push('jsH')
    <script type="text/javascript"
    src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.0/jquery.min.js"></script>
    <script type="text/javascript"
    src="https://openpay.s3.amazonaws.com/openpay.v1.min.js"></script>
    <script type='text/javascript'
    src="https://openpay.s3.amazonaws.com/openpay-data.v1.min.js"></script>

    <link href="//cdn.jsdelivr.net/npm/@sweetalert2/theme-dark@4/dark.css" rel="stylesheet">
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.js"></script>


    <script>
        $(document).ready(function() {

            OpenPay.setId('mkonampxt6onh9ddekio');
            OpenPay.setApiKey('pk_80f9b25ee42c4549bc327649de298c64');
            OpenPay.setSandboxMode(true);
            //Se genera el id de dispositivo
            var deviceSessionId = OpenPay.deviceData.setup("payment-form", "deviceIdHiddenFieldName");

            $('#pay-button').on('click', function(event) {
                event.preventDefault();
                $("#pay-button").prop( "disabled", true);
                OpenPay.token.extractFormAndCreate('payment-form', sucess_callbak, error_callbak);
            });

            var sucess_callbak = function(response) {
              var token_id = response.data.id;
              $('#token_id').val(token_id);
              $('#payment-form').submit();
            };

            var error_callbak = function(response) {
                var desc = response.data.description != undefined ? response.data.description : response.message;
                Swal.fire('Oooooops! '+ response.status, desc);
                //)
                //alert("ERROR [" + response.status + "] " + desc);
                $("#pay-button").prop("disabled", false);
            };

        });
    </script>
@endpush

@section('content')
    @include('users.partials.header', [
        'title' => __('Bienvenido!') ,
        'description' => __('Esta es tu página de pago. Puede realizar el pago de sus productos.        '),
        'class' => 'col-lg-7'
    ])
    <div>
        <pago-component/>
        @include('layouts.footers.auth')
    </div>


@endsection
