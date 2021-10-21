<template>
<div>
    <form>
                  <div class="header bg-gradient-primary pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Negocios</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a v-bind:href="'/inicio'">Inicio</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Negocios</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <button type="button" class="btn btn-sm btn-neutral" @click="nuevoNegocio()">Nuevo Negocio</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
                
    <!--
        <div class="row">
            <div class="col-md-6">
                <div class="form-group">
                    <div class="alert alert-secondary" role="alert">
                        <strong>Valor Variable!</strong> {{ negocio }}
                    </div>
                </div>
            </div>
      </div>-->                  
                    <!-- TABLA -->
              <div class="container-fluid mt--6">
                <div class="row">
                  <div class="col">
                    <div class="card">
                      <div class="table-responsive">
                          <div>
                              <table class="table align-items-center table-dark">
                                  <thead class="thead-dark">
                                      <tr>
                                          <th scope="col" class="sort" data-sort="name">Nombre</th>
                                          <th></th>
                                          <th scope="col" class="sort" data-sort="budget">Descripci&oacute;n</th>
                                          <th scope="col" class="sort" data-sort="status">Categor&iacute;a:</th>
                                          <th scope="col">Giro:</th>
                                          <th scope="col" class="sort" data-sort="completion">Telefono</th>
                                          <th scope="col"></th>
                                      </tr>
                                  </thead>
                                    <paginate name="var_negocios" :per="10" :list="lista_negocios"  tag="tbody" class="list">                  
                                      <tr v-for="v_negocio in paginated('var_negocios')">
                                          <td class="budget">
                                              {{ v_negocio.nombre }}
                                          </td>
                                          <td>
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" @click="abrirFoto(v_negocio.foto)" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+v_negocio.foto">
                                            </a>
                                          </td>
                                          <td>
                                              {{ v_negocio.descripcion }}
                                          </td>
                                          <td> 
                                            {{ v_negocio.categoria }}                              
                                          </td>
                                          <td>
                                              {{ v_negocio.giro }}
                                          </td>
                                          <td>
                                              {{ v_negocio.telefono }}
                                          </td>
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-light"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                      <button  type="button" class="dropdown-item" @click="editar_negocio(v_negocio)">Modificar</button>
                                                      <button  type="button" class="dropdown-item" @click="eliminarNegocio(v_negocio)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                    </paginate>
                              </table>
                          </div>
                                    <paginate-links for="var_negocios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                               
                    </div>
                  </div>
                </div>
              </div>
          </div>

              <!-- Modal -->
              <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Negocio:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <input type="text" class="form-control" id="nombreNegocio" v-model="negocio.nombre" placeholder="Nombre del Negocio...">
                                  <br>
                                  <textarea class="form-control" id="descripcionNegocio" v-model="negocio.descripcion" rows="3" placeholder="Escribe una descripción del negocio..."></textarea>
                                  <br>
                                  <input type="text" class="form-control" id="categoriaNegocio" v-model="negocio.categoria" placeholder="Categoria del Negocio...">
                                  <br>
                                  <input type="text" class="form-control" id="giroNegocio" v-model="negocio.giro" placeholder="Giro del Negocio...">
                                  <br>
                                  <input type="number" class="form-control" id="telefono" v-model="negocio.telefono" placeholder="telefono del negocio">
                                   <br>   
                                  <textarea class="form-control" id="etiquetasNegocio" v-model="negocio.etiquetas" rows="3" placeholder="Escribe etiquetas sobre el negocio..."></textarea>
                                  <br>
                                  <input type="file" class="form-control" id="foto"  accept="image/*" @change="subirFoto">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-primary" @click="guardarNegocio">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionNegocio" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea eliminar este negocio?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" @click="eliminar_negocio()" id="botoncito">Eliminar</button>
                    </div>
                  </div>
                </div>
              </div>
              
              <div class="modal fade" id="viewfoto" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Vista</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <img :src="'/storage/'+this.ruta" style="width: 100%; height: 300px;" >
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-primary" @click="cerrarIMG()" id="botoncito">Cerrar</button>
                    </div>
                  </div>
                </div>
              </div>
    </form> 
</div> 
</template>

<script>
    import VuePaginate from "vue-paginate";

    export default {
        mounted() {
            console.log('Component mounted.')
            this.listar_negocios();
        }
        ,data(){
            return {
                negocio: {},
                lista_negocios:{},
                editando:false,
                ruta : '',
                paginate: ['var_negocios']
            }
        },methods:{
            subirFoto(e){
                this.negocio.foto = e.target.files[0];
            },
            guardarNegocio(){
                const datosNegocio = new FormData;
                datosNegocio.set('nombre',this.negocio.nombre);
                datosNegocio.set('descripcion',this.negocio.descripcion);
                datosNegocio.set('categoria',this.negocio.categoria);
                datosNegocio.set('giro',this.negocio.giro);
                datosNegocio.set('telefono',this.negocio.telefono);
                datosNegocio.set('etiquetas',this.negocio.etiquetas);
                datosNegocio.set('foto',this.negocio.foto);
                if(this.editando){
                  datosNegocio.set('id',this.negocio.id);
                   axios.post('/edit_negocio',datosNegocio)
                    .then((response) => {
                      this.negocio = {};
                      this.listar_negocios();
                      this.nuevoNegocio();
                    })
                    .catch((error)=>{
                        console.log(error.response);
                    })
                }else{
                    axios.post('/guardar_negocio',datosNegocio)
                    .then((response) => {
                      this.negocio = {};
                      this.listar_negocios();
                      this.nuevoNegocio();
                    })
                    .catch((error)=>{
                        console.log(error.response);
                    })
                }
            },
            listar_negocios(){
                axios.get('/lista_negocios')
                .then((response) => {
                    this.lista_negocios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            editar_negocio(param_negocio){
              this.editando = true;
              this.negocio = param_negocio;
              this.nuevoNegocio();
            },
            eliminar_negocio(){
               axios.delete('/eliminar_negocio/'+this.negocio.id)
              .then((response) => {
                    this.lista_negocios = response;
                    this.negocio = {};
                    $("#eliminacionNegocio").modal("toggle");
                })
                .catch((error)=>{
                    console.log(error.response);
                })
                this.listar_negocios();           
            },nuevoNegocio(){
              $("#formulario").modal("toggle");
            }, eliminarNegocio(param_negocio){
              $("#eliminacionNegocio").modal("toggle");
              this.negocio = param_negocio;
            }, cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.negocio = {};
            }, cerrarIMG(){
              this.ruta = '';
              $("#viewfoto").modal("toggle");
            }, abrirFoto(ruta){
              this.ruta = ruta;
              $("#viewfoto").modal("toggle");
            }
        }
    }
</script>
