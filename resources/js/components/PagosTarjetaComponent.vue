<template>
    <div>
            <div class="container-fluid">




                    <div class="col">
                        <div class="card bg-secondary shadow">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">&nbsp;Cuenta Bancaria</h3>
                                </div>
                            </div>
                            <div class="card-body">
                                <form id="payment-form" method="post" action="/procesarPagos"  autocomplete="off">
                                    <h6 class="heading-small text-muted mb-4">Informaci&oacute;n de Cuenta Bancaria</h6>
                                    <input type="hidden" name="token_id" id="token_id">
                                    <input type="hidden" name="_token" :value="csrf">
                                    <div class="pl-lg-4">
                                        <div class="">
                                            <label class="form-control-label" for="input-name">N&uacute;mero de Cuenta:</label>
                                            <input type="number" name="nCuenta" id="nCuenta" class="form-control form-control-alternative" data-openpay-card="card_number" placeholder="4111111111111111" required autofocus>
                                        </div>
                                        <div class="">
                                            <label class="form-control-label" for="input-email">Nombre:</label>
                                            <input type="text" name="name" id="name" class="form-control form-control-alternative" data-openpay-card="holder_name" required>
                                        </div>
                                        <div class="form-row">
                                            <div class="col">
                                                <label class="form-control-label" for="input-email">Mes:</label>
                                                <input type="number" id="mes" name="mes" class="form-control form-control-alternative" data-openpay-card="expiration_month" min="1" max="12" placeholder="01-12">
                                            </div>
                                            <div class="col">
                                                <label class="form-control-label" for="input-email">A&ntilde;o:</label>
                                                <input type="number" id="anio" name="anio" class="form-control form-control-alternative" data-openpay-card="expiration_year" min="21" placeholder="21">
                                            </div>
                                            <div class="col">
                                                <label class="form-control-label" for="input-email">CCV:</label>
                                                <input type="number" id="ccv" name="ccv" class="form-control form-control-alternative" data-openpay-card="cvv2" placeholder="010">
                                            </div>
                                        </div>
                                        <div class="text-center">
                                            <!--<button type="button" id="pay-button" class="btn btn-success mt-4">Guardar</button>-->
                                            <button type="button" @click="pagoTarjeta" class="btn btn-success mt-4">Guardar</button>
                                        </div>
                                    </div>
                                </form>
                                <hr class="my-4" />
                            </div>
                        </div>
                    </div>
                </div>

    </div>
</template>
<script>
export default{
    mounted(){
        console.log("Component mounted.")
    }, data(){
        return{
        csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        datas: {}
        }
    },methods:{
        pagoTarjeta(){
            let timerInterval
            Swal.fire({
            title: 'Procesando su Pago!',
            html: 'Su pago estara listo en <b></b> milisegundos.',
            timer: 2000,
            timerProgressBar: true,
            didOpen: () => {
                Swal.showLoading()
                const b = Swal.getHtmlContainer().querySelector('b')
                timerInterval = setInterval(() => {
                b.textContent = Swal.getTimerLeft()
                }, 100)
            },
            willClose: () => {
                clearInterval(timerInterval)
                Swal.fire({
                position: 'center',
                icon: 'success',
                title: 'Su pago fue exitoso',
                showConfirmButton: false,
                timer: 1500
            }),
            axios.get('/pagar').then((response)=>{
                window.location.href = "/carrito";
                }).catch((error)=>{
                })
            }
            }).then((result) => {
            /* Read more about handling dismissals below */
            if (result.dismiss === Swal.DismissReason.timer) {
                console.log('I was closed by the timer')
            }
            });

        }
    }
}
</script>
