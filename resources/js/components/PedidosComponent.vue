<template>
    <div>
        <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(&quot;../argon/img/theme/profile-cover.jpg&quot;); background-size: cover; background-position: center top;"><span class="mask bg-gradient-default opacity-8"></span> <div class="container-fluid d-flex align-items-center"><div class="row"><div class="col-md-12 col-lg-7"><h1 class="display-2 text-white">Bienvenido!</h1> <p class="text-white mt-0 mb-5">Esta es tu página de pedidos. Puede ver los pedidos.</p></div></div></div></div>
        <div class="card bg-secondary shadow">


            <div class="nav-wrapper">
                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-watch-time mr-2"></i>Pendientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-square-pin mr-2"></i>Enviados</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-3-tab" data-toggle="tab" href="#tabs-icons-text-3" role="tab" aria-controls="tabs-icons-text-3" aria-selected="false"><i class="ni ni-check-bold mr-2"></i>Entregados</a>
                    </li>
                </ul>
            </div>
            <div class="card shadow">
                <div class="card-body">
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">&nbsp;Pendientes</h3>
                                </div>
                            </div>
                           <paginate name="var_pendientes" :per=5 :list="pendientes" class="card-body">
                                <div  v-for="pendiente in paginated('var_pendientes')">
                                    <form method="post" autocomplete="off">
                                        <div class="pl-lg-4">

                                                 <div>
                                            <div role="alert"  class="alert alert-secondary" >
                                                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+pendiente.foto">
                                            </a>
                                                <strong>{{pendiente.nombre}}</strong><br>
                                                <b>Cantidad:</b> {{pendiente.cantidad}}<br>
                                                <b>Cliente:</b> {{pendiente.name}}<br>
                                                <b>Direccion:</b> {{pendiente.calle}} MZ {{pendiente.exterior}} INT {{pendiente.interior}} COL {{pendiente.colonia}} {{pendiente.codigoPostal}}
                                              {{pendiente.localidad}} {{pendiente.estado}}
                                                <button type="button"  aria-label="Close" class="close" @click="enviar(pendiente.idItem)" >
                                                    <span aria-hidden="true"><i class="ni ni-button-play"></i></span>
                                                </button>
                                                <br>
                                            </div>
                                            <hr class="my-4">
                                            </div>


                                        </div>
                                    </form>
                                    </div>
                            </paginate>
                            <nav aria-label="...">
                                <paginate-links for="var_pendientes" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                            </nav>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                          <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">&nbsp;Enviados</h3>
                                </div>
                            </div>
                             <paginate name="var_enviados" :per=10 :list="enviados" class="card-body">
                                <div  v-for="enviados in paginated('var_enviados')">
                                    <form method="post" autocomplete="off">
                                        <div class="pl-lg-4">

                                                 <div>
                                            <div role="alert"  class="alert alert-secondary" >
                                                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+enviados.foto">
                                            </a>
                                                <strong>{{enviados.nombre}}</strong><br>
                                                <b>Cantidad:</b> {{enviados.cantidad}}<br>
                                                <b>Cliente:</b> {{enviados.name}}<br>
                                                <b>Direccion:</b> {{enviados.calle}} MZ {{enviados.exterior}} INT {{enviados.interior}} COL {{enviados.colonia}} {{enviados.codigoPostal}}
                                              {{enviados.localidad}} {{enviados.estado}}
                                                <button type="button"  aria-label="Close" class="close" @click="entregar(enviados.idItem)" >
                                                    <span aria-hidden="true"><i class="ni ni-button-play"></i></span>
                                                </button>
                                                <br>
                                            </div>
                                            <hr class="my-4">
                                            </div>


                                        </div>
                                    </form>
                                    </div>

                                </paginate>
                            <nav aria-label="...">
                                <paginate-links for="var_enviados" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                            </nav>
                        </div>
                        <div class="tab-pane fade" id="tabs-icons-text-3" role="tabpanel" aria-labelledby="tabs-icons-text-3-tab">
                            <div class="card-header bg-white border-0">
                                <div class="row align-items-center">
                                    <h3 class="mb-0">&nbsp;Entregados</h3>
                                </div>
                            </div>
                             <paginate name="var_entregados" :per=10 :list="entregados" class="card-body">
                               <div  v-for="entregado in paginated('var_entregados')">
                                    <form method="post" autocomplete="off">
                                        <div class="pl-lg-4">

                                                 <div>
                                            <div role="alert"  class="alert alert-secondary" >
                                                <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+entregado.foto">
                                            </a>
                                                <strong>{{entregado.nombre}}</strong><br>
                                                <b>Cantidad:</b> {{entregado.cantidad}}<br>
                                                <b>Cliente:</b> {{entregado.name}}<br>
                                                <b>Direccion:</b> {{entregado.calle}} MZ {{entregado.exterior}} INT {{entregado.interior}} COL {{entregado.colonia}} {{entregado.codigoPostal}}
                                              {{entregado.localidad}} {{entregado.estado}}
                                                <br>
                                            </div>
                                            <hr class="my-4">
                                            </div>


                                        </div>
                                    </form>
                                    </div>


                                </paginate>
                            <nav aria-label="...">
                                <paginate-links for="var_entregados" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</template>
<script>
    import VuePaginate from "vue-paginate";
    export default{
        mounted(){
            console.log("Component mounted.")
            this.listartodo();
        }, data(){
            return{
                pendientes:{},
                enviados: {},
                entregados: {},
                paginate: ['var_pendientes', 'var_enviados', 'var_entregados']
            }
        }, methods:{
            listar_pendientes(){
                axios.get('/pendientes').then((response)=>{
                    console.log('asdasdsadasd');
                    this.pendientes = response.data;
                }).catch((error)=>{
                    console.log('asdasdasdasdasdq3w123234');
                    console.log(error.response);
                })
            }, listar_enviados(){
                axios.get('/enviados').then((response)=>{
                    this.enviados = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            }, listar_entregados(){
                axios.get('/entregados').then((response)=>{
                    this.entregados = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            }
            , enviar(id){
                Swal.fire({
                    title: 'Envio?',
                    text: "¿Estas seguro que deseas enviar este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Envialo!',
                    cancelButtonText: 'No! Olvidalo'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Enviado!',
                        'El producto se envio.',
                        'success'
                        )
                        axios.get("/enviar/"+id).then((response)=>{
                        this.listartodo();
                                    }).catch((error)=>{
                                        console.log(error.response)
                                    })
                            }
                    })
            }, entregar(id){
                Swal.fire({
                    title: 'Entregado?',
                    text: "¿Estas seguro que entregaste este producto?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Si, Lo entregue!',
                    cancelButtonText: 'No! Aun no'
                    }).then((result) => {
                    if (result.isConfirmed) {
                        Swal.fire(
                        'Entregado!',
                        'El producto se guardo exitosamente.',
                        'success'
                        )
                        axios.get("/entregar/"+id).then((response)=>{
                        this.listartodo();
                                    }).catch((error)=>{
                                        console.log(error.response)
                                    })
                            }
                    })
            }, listartodo(){
                this.listar_pendientes();
                this.listar_enviados();
                this.listar_entregados();
            }
        }
    }
</script>

