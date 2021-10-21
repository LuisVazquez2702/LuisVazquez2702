<template>
    <div>
        <form>
                  <div class="header bg-gradient-primary pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Direcciones</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a v-bind:href="'/inicio'">Inicio</a></li>
                              <li class="breadcrumb-item"><a v-bind:href="'/clientes'">Clientes</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Direccion</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <button type="button" class="btn btn-sm btn-neutral" @click="nuevaDireccion">Nueva Direccion</button>
                          
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
              <h3 class="mb-0">Direcciones</h3>
              <a  v-bind:href="'/clientes'" class="badge badge-primary"><i class="ni ni-bold-left text-default"></i> Regresar</a>
            </div>          
                <div class="table-responsive">
                        <div>
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Nombre</th>
                                        <th scope="col" class="sort" data-sort="name">Dirreci&oacute;n</th>

                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                  <paginate name="ver_direcciones" :per=10 :list="lista_direccion"  tag="tbody" class="list">                    
                                      <tr v-for="v_direccion in paginated('ver_direcciones')">         
                                          <td class="budget">
                                              <div v-for="cliente in select_clientes">
                                                  <div v-if="v_direccion.id_cliente==cliente.id">
                                                    {{cliente.nombre}} {{cliente.apellidos}}
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                    <a href="#" class="avatar avatar-sm" data-toggle="tooltip" @click="abrirFoto(cliente.foto)" data-original-title="Romina Hadid">
                                                          <img alt="Image placeholder" :src="'/storage/'+cliente.foto">
                                                    </a>
                                                  </div>
                                              </div>
                                          </td>
                                          <td>
                                              {{v_direccion.calle}} MZ {{v_direccion.exterior}} INT {{v_direccion.interior}} COL {{v_direccion.colonia}} {{v_direccion.codigoPostal}}
                                              {{v_direccion.localidad}} {{v_direccion.estado}}
                                          </td>
                                         
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-light"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                      <button  type="button" class="dropdown-item" @click="editar_direccion(v_direccion)">Modificar</button>
                                                      <button  type="button" class="dropdown-item"@click="eliminarDireccion(v_direccion)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                      </paginate>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                          <nav aria-label="...">
                              <paginate-links for="ver_direcciones" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                          </nav>
                        </div>
                </div> 
            </div>
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
                      <h5 class="modal-title" id="exampleModalLabel">Direccion:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                   <label>Cliente:</label>
                                  <select name="select" class="form-control"  v-model="direccion.id_cliente" >
                                      <option v-for="cliente in select_clientes" :value="cliente.id">{{cliente.nombre}} {{cliente.apellidos}}</option>                     
                                  </select>
                                  <br>
                                  <input type="text" class="form-control" id="calle" v-model="direccion.calle" placeholder="Calle...">
                                  <br>
                                  <input type="number" class="form-control" id="exterior" v-model="direccion.exterior"  placeholder="Numero Exterior...">
                                  <br>                                  
                                  <input type="number" class="form-control" id="interior" v-model="direccion.interior" placeholder="Numero Interior...">
                                  <br>
                                  <input type="text" class="form-control" id="codigoPostal" v-model="direccion.colonia" placeholder="Colonia...">
                                  <br>
                                  <input type="number" class="form-control" id="codigoPostal" v-model="direccion.codigoPostal" placeholder="Código Postal...">
                                  <br>
                                  <input type="text" class="form-control" id="localidad" v-model="direccion.localidad" placeholder="Localidad...">
                                  <br>
                                  <input type="text" class="form-control" id="estado" v-model="direccion.estado" placeholder="Estado...">
                                  <br>
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary"  @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-primary" @click="guardarDirrecion()">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionDireccion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea eliminar esta Direcci&oacute;n?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" @click="eliminar_direccion" id="botoncito">Eliminar</button>
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
    export default {
        mounted() {
            console.log('Component mounted.')
            this.listar_direcciones();
            this.clientes();
        }
        ,data(){
            return {
                direccion: {},
                lista_direccion:{},
                editando:false,
                select_clientes:{},
                ruta : '',
                paginate: ['ver_direcciones']
            }
        },methods:{
            clientes(){
              axios.get('/clientes_listar')
                .then((response) => {
                    this.select_clientes = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            guardarDirrecion(){
              if(this.editando){
                    axios.post("/direcciones_editar", this.direccion).then((response)=>{
                      this.direccion = {};
                      this.nuevaDireccion();
                      this.listar_direcciones();
                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }else{
                    axios.post("/direcciones_guardar", this.direccion).then((response)=>{
                      this.direccion = {};
                      this.nuevaDireccion();
                      this.listar_direcciones();
                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }
            },
            listar_direcciones(){
                axios.get("/direcciones_listar").then((response)=>{
                    this.lista_direccion = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
            },
            editar_direccion(param_direccion){
               this.editando = true;
               this.direccion = param_direccion;
               this.nuevaDireccion();
            },
            eliminar_direccion(){
                axios.delete("/direcciones_eliminar/"+this.direccion.id).then((response)=>{
                  this.lista_direccion = response;
                  this.direccion = {};
                  $("#eliminacionDireccion").modal("toggle");
                }).catch((error)=>{
                  console.log(error.response);
                })
                this.listar_direcciones();
            },nuevaDireccion(){
              $("#formulario").modal("toggle");
            }, eliminarDireccion(param_direccion){
              $("#eliminacionDireccion").modal("toggle");
              this.direccion = param_direccion;
            }, cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.direccion = {};
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
