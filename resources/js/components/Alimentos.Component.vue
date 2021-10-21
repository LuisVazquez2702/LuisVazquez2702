<template>
    <div>
        <form>
                  <div class="header bg-gradient-primary pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Alimentos</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a v-bind:href="'/inicio'">Inicio</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Alimentos</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <button type="button" @click="nuevoAlimento()" class="btn btn-sm btn-neutral">Nuevo Alimento</button>
                        </div>
                      </div>
                    </div>
                  </div>
                </div>
<!--ALIMENTOS-->
    <div class="container-fluid mt--6">
      <div class="row">
        <div class="col">
          <div class="card">
            <!-- Card header -->
            <div class="card-header border-0">
              <h3 class="mb-0">Alimentos</h3>
            </div>


                <div class="table-responsive">
                        <div>
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Nombre</th>
                                        <th></th>
                                        <th scope="col" class="sort" data-sort="name">Negocio:</th>
                                        <th scope="col" class="sort" data-sort="budget">Porci&oacute;n:</th>
                                        <th scope="col" class="sort" data-sort="status">Precio:</th>
                                        <th scope="col">Descripci&oacute;n:</th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                  <paginate name="var_alimentos" :per="10" :list="lista_alimentos" tag="tbody" class="list">
                                    <tr v-for="v_alimento in paginated('var_alimentos')">
                                          <td class="budget">
                                              {{ v_alimento.nombre }}
                                          </td>
                                          <td>
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" @click="abrirFoto(v_alimento.foto)" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+v_alimento.foto">
                                            </a>
                                          </td>
                                          <td class="budget">
                                            {{ v_alimento.nego_name}}
                                          </td>
                                          <td>
                                              {{ v_alimento.porcion }}
                                          </td>
                                          <td>
                                            ${{ around(v_alimento.precio) }} MXN
                                          </td>
                                          <td>
                                              {{ v_alimento.descripcion }}
                                          </td>
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-light"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                      <button  type="button" class="dropdown-item" @click="editar_alimento(v_alimento)">Modificar</button>
                                                      <button  type="button" class="dropdown-item" @click="eliminarAlimento(v_alimento)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                    </paginate>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                          <nav aria-label="...">
                              <paginate-links for="var_alimentos" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                          </nav>
                        </div>


                </div>
            </div>
            <a v-bind:href="'/reporte'" class="btn btn-icon btn-3 btn-primary justify-content-end" type="button">
                            <span class="btn-inner--icon"><i class="ni ni-bag-17"></i></span>
                            <span class="btn-inner--text">Reporte de Ventas</span>
            </a>
            <div>
              <br>
              <br>


      <!--  -->
                      </div>
                  </div>
                </div>
              </div>
                  <!-- Modal -->
              <div class="modal fade" id="formulario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Alimento:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <input type="text" class="form-control" id="nombre" v-model="alimento.nombre" placeholder="Nombre del Alimento...">
                                  <br>
                                  <input type="text" class="form-control" id="porcion" v-model="alimento.porcion"  placeholder="Porcion del Alimento...">
                                  <br>
                                  <div v-if="logeado.tipo_usuario==1">
                                  <label>Negocio:</label>
                                  <select name="select" class="form-control"  v-model="alimento.id_negocio">
                                      <option v-for="nego in select_negocio" :value="nego.id" >{{nego.nombre}}</option>
                                  </select>
                                  <br>
                                  </div>
                                  <input type="number" class="form-control" id="precio" v-model="alimento.precio"  placeholder="Precio del Alimento...">
                                  <br>
                                  <textarea class="form-control" id="descripcion"  rows="3" v-model="alimento.descripcion" placeholder="Escribe una descripción del Alimento..."></textarea>
                                  <br>
                                  <input type="file" class="form-control" id="foto"  accept="image/*" @change="subirFoto">

                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-primary"  @click="guardarAlimento()">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionAlimento" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea eliminar este Alimento?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" @click="eliminar_alimento()" id="botoncito">Eliminar</button>
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
            this.listar_alimento();
            this.negocios();
            this.usuarioEspec();
        }
        ,data(){
            return {
                alimento: {},
                lista_alimentos:{},
                editando:false,
                select_negocio:{},
                ruta : '',
                paginate: ['var_alimentos'],
                logeado: {}
            }
        },methods:{
            subirFoto(e){
                this.alimento.foto = e.target.files[0];
            },
            negocios(){
              axios.get('/lista_negocios')
                .then((response) => {
                    this.select_negocio = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            guardarAlimento(){
              if(this.logeado.tipo_usuario == 2){
                this.alimento.id_negocio = this.logeado.id
              }
              const datosAlimento = new FormData
              datosAlimento.set('nombre',this.alimento.nombre);
              datosAlimento.set('porcion',this.alimento.porcion);
              datosAlimento.set('id_negocio',this.alimento.id_negocio);
              datosAlimento.set('precio',this.alimento.precio);
              datosAlimento.set('descripcion',this.alimento.descripcion);
              datosAlimento.set('foto', this.alimento.foto);
              if(this.editando){
                    datosAlimento.set('id', this.alimento.id);
                    axios.post("/alimentos_editar", datosAlimento).then((response)=>{
                      this.alimento = {};
                      this.listar_alimento();
                      this.nuevoAlimento();

                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }else{
                    axios.post("/alimentos_guardar", datosAlimento).then((response)=>{
                      this.alimento = {};
                      this.listar_alimento();
                      this.nuevoAlimento();
                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }
            },
            listar_alimento(){
                axios.get("/alimentos_listar").then((response)=>{
                    this.lista_alimentos = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
            },
            editar_alimento(param_alimento){
               this.editando = true;
               this.alimento = param_alimento;
               this.nuevoAlimento();
            },
            eliminar_alimento(){
                axios.delete("/alimentos_eliminar/"+this.alimento.id).then((response)=>{
                  this.lista_alimentos = response;
                  this.alimento = {};
                  $("#eliminacionAlimento").modal("toggle");
                }).catch((error)=>{
                  console.log(error.response);
                })
                this.listar_alimento();
            },nuevoAlimento(){
              $("#formulario").modal("toggle");
            }, eliminarAlimento(param_negocio){
              $("#eliminacionAlimento").modal("toggle");
              this.alimento = param_negocio;
            }, cerrarModal(){
              $("#formulario").modal("toggle");
              this.editando=false;
              this.alimento = {};
            }, cerrarIMG(){
              this.ruta = '';
              $("#viewfoto").modal("toggle");
            }, abrirFoto(ruta){
              this.ruta = ruta;
              $("#viewfoto").modal("toggle");
            },
            usuarioEspec(){
                axios.get('/usuarioEspec')
                .then((response) => {
                    this.logeado = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            }, around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         }
        }
    }
</script>
