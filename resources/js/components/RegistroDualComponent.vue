<template>
    <div>
        <form>
                  <div class="header bg-gradient-primary pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Completado de Registro</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a href="#">Registro</a></li>
                            </ol>
                          </nav>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
            <div class="container-fluid mt--6">
                <div class="row">
                    <div class="col">
                        <div class="card">

                            <div class="nav-wrapper">
                                <ul class="nav nav-pills nav-fill flex-column flex-md-row" id="tabs-icons-text" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-icons-text-1-tab" data-toggle="tab" href="#tabs-icons-text-1" role="tab" aria-controls="tabs-icons-text-1" aria-selected="true"><i class="ni ni-credit-card"></i>&nbsp;&nbsp;Cliente</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link mb-sm-3 mb-md-0" id="tabs-icons-text-2-tab" data-toggle="tab" href="#tabs-icons-text-2" role="tab" aria-controls="tabs-icons-text-2" aria-selected="false"><i class="ni ni-shop text-default"></i>&nbsp;&nbsp;Negocio</a>
                                    </li>
                                </ul>
                            </div>
                            <div class="card shadow">
                                <div class="card-body">
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="tabs-icons-text-1" role="tabpanel" aria-labelledby="tabs-icons-text-1-tab">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"  v-model="cliente.nombre" id="exampleFormControlInput1" placeholder="Nombre(s)">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="text" class="form-control form-control-alternative"  v-model="cliente.apellidos"  id="exampleFormControlInput1" placeholder="Apellido(s)">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <input type="number" class="form-control form-control-alternative" v-model="cliente.telefono"    id="exampleFormControlInput1" placeholder="Telefono">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Fecha de Nacimiento:</label>
                                                        <input type="Date" class="form-control form-control-alternative" v-model="cliente.fecha_nacimiento"  id="exampleFormControlInput1" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>Foto de Perfil:</label>
                                                        <input type="file" class="form-control form-control-alternative" id="foto"  accept="image/*"  @change="subirFoto">
                                                    </div>
                                                </div>
                                            </div>
                                            <center>
                                                <button type="button" class="btn btn-primary btn-lg" @click="guardarCliente()" >Guardar</button>
                                            </center>
                                        </div>
                                        <div class="tab-pane fade" id="tabs-icons-text-2" role="tabpanel" aria-labelledby="tabs-icons-text-2-tab">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <input type="text" class="form-control form-control-alternative" id="nombreNegocio"  v-model="negocio.nombre"  placeholder="Nombre del Negocio...">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <textarea class="form-control form-control-alternative" id="descripcionNegocio"  rows="3" v-model="negocio.descripcion" placeholder="Escribe una descripción del negocio..."></textarea>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-alternative" id="categoriaNegocio"  v-model="negocio.categoria" placeholder="Categoria del Negocio...">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <input type="text" class="form-control form-control-alternative" id="giroNegocio" v-model="negocio.giro" placeholder="Giro del Negocio...">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                            <input type="number" class="form-control form-control-alternative" id="telefono" v-model="negocio.telefono"  placeholder="telefono del negocio">
                                                            </div>
                                                        </div>  
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <textarea class="form-control form-control-alternative" id="etiquetasNegocio" v-model="negocio.etiquetas"  rows="3" placeholder="Escribe etiquetas sobre el negocio..."></textarea>
                                                    </div>
                                                        </div>
                                                    </div>
                                                    <input type="file" class="form-control form-control-alternative" id="foto"  accept="image/*" @change="subirFoto">
                                                    <br>
                                                        <center>
                                                <button type="button" class="btn btn-primary btn-lg" @click="guardarNegocio">Guardar</button>
                                            </center>

                                        </div>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
    export default {
        mounted(){            
        },
        data(){
            return{
                cliente: {},
                negocio: {},
                foto: null,
            }
        },
        methods:{
            subirFoto(e){
                this.foto = e.target.files[0];
            },
            guardarNegocio(){
                const datosNegocio = new FormData;
                datosNegocio.set('nombre',this.negocio.nombre);
                datosNegocio.set('descripcion',this.negocio.descripcion);
                datosNegocio.set('categoria',this.negocio.categoria);
                datosNegocio.set('giro',this.negocio.giro);
                datosNegocio.set('telefono',this.negocio.telefono);
                datosNegocio.set('etiquetas',this.negocio.etiquetas);
                datosNegocio.set('foto',this.foto);
                axios.post('/negocioGuardar',datosNegocio)
                    .then((response) => {
                        window.location="/inicio";                
                    })
                    .catch((error)=>{
                        console.log(error.response);
                        alert(error.response)
                    })
            },
             guardarCliente(){
              const datosCliente = new FormData
              datosCliente.set('nombre',this.cliente.nombre);
              datosCliente.set('apellidos', this.cliente.apellidos);
              datosCliente.set('telefono', this.cliente.telefono);
              datosCliente.set('fecha_nacimiento', this.cliente.fecha_nacimiento);
              datosCliente.set('foto', this.foto);
              axios.post("/clienteGuardar", datosCliente).then((response)=>{
                        window.location="/inicio";     
                    }).catch((error)=>{
                      console.log(error.response);
                    })
                
            },
        }
    }
</script>
