<template>
    <div>
        <form>
                  <div class="header bg-gradient-primary pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Clientes</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a v-bind:href="'/inicio'">Inicio</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Clientes</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <button type="button" @click="nuevoCliente()" class="btn btn-sm btn-neutral">Nuevo Cliente</button>
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
              <h3 class="mb-0">Clientes</h3>
              <a  v-bind:href="'/direcciones'" class="badge badge-primary"><i class="ni ni-bold-right text-default"></i> Nueva Direcci&oacute;n</a>
            </div>
                      
                <div class="table-responsive">
                        <div>
                            <table class="table align-items-center">
                                <thead class="thead-light">
                                    <tr>
                                        <th scope="col" class="sort" data-sort="name">Nombre:</th>
                                        <th></th>
                                        <th scope="col" class="sort" data-sort="budget">Telefono:</th>
                                        <th scope="col" class="sort" data-sort="status">Fecha de Nacimiento:</th>
                                        <th></th>
                                    </tr>
                                </thead>
                                  <paginate name="var_clientes" :per=10 :list="lista_clientes"  tag="tbody" class="list">                    
                                      <tr v-for="v_cliente in paginated('var_clientes')">
                                          <td class="budget">
                                              {{v_cliente.nombre}} {{v_cliente.apellidos}}
                                          </td>
                                          <td>
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" @click="abrirFoto(v_cliente.foto)" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+v_cliente.foto">
                                            </a>
                                          </td>                                          
                                          <td>
                                              {{v_cliente.telefono}}
                                          </td>
                                          <td> 
                                               {{v_cliente.fecha_nacimiento}}                           
                                          </td>
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-light"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                      <button  type="button" class="dropdown-item" @click="editar_cliente(v_cliente)">Modificar</button>
                                                      <button  type="button" class="dropdown-item" @click="eliminarCliente(v_cliente)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                    </paginate>
                            </table>
                        </div>
                        <div class="card-footer py-4">
                          <nav aria-label="...">
                              <paginate-links for="var_clientes" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
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
                      <h5 class="modal-title" id="exampleModalLabel">Cliente:</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                                <!-- FORMULARIO -->
                                  <input type="text" class="form-control" id="nombre" v-model="cliente.nombre" placeholder="Nombre del Cliente...">
                                  <br>
                                  <input type="text" class="form-control" id="apellidos" v-model="cliente.apellidos"   placeholder="Apellidos del Cliente...">
                                  <br>
                                  <input type="number" class="form-control" id="telefono" v-model="cliente.telefono"   placeholder="Telefono del Cliente...">
                                  <br>
                                  <div class="form-group">
                                      <div class="input-group input-group-alternative">
                                          <div class="input-group-prepend">
                                              <span class="input-group-text"><i class="ni ni-calendar-grid-58"></i></span>
                                          </div>
                                          <input class="form-control datepicker" v-model="cliente.fecha_nacimiento" id="fecha_nacimiento" type="date">
                                      </div>
                                  </div>
                                  <input type="file" class="form-control" id="foto"  @change="subirFoto"  accept="image/*" >
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="cerrarModal" >Cerrar</button>
                      <button type="button" class="btn btn-primary" @click="guardarCliente()" >Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionCliente" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-dialog-centered" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="exampleModalLabel">Eliminar</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <h4>¿Seguro que desea eliminar este Cliente?</h4>
                      </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                      <button type="button" class="btn btn-primary" @click="eliminar_cliente()" id="botoncito">Eliminar</button>
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
            this.listar_cliente();
        }
        ,data(){
            return {
                cliente: {},
                lista_clientes:{},
                editando:false,
                ruta : '', 
                paginate: ['var_clientes']
            }
        },methods:{
            subirFoto(e){
                this.cliente.foto = e.target.files[0];
            },
            guardarCliente(){
              const datosCliente = new FormData
              datosCliente.set('nombre',this.cliente.nombre);
              datosCliente.set('apellidos', this.cliente.apellidos);
              datosCliente.set('telefono', this.cliente.telefono);
              datosCliente.set('fecha_nacimiento', this.cliente.fecha_nacimiento);
              datosCliente.set('foto', this.cliente.foto);
              if(this.editando){
                    datosCliente.set('id', this.cliente.id);
                    axios.post("/clientes_editar", datosCliente).then((response)=>{
                      this.cliente = {};
                      this.listar_cliente();
                      this.nuevoCliente();
                      this.editando=false;
                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }else{
                    axios.post("/clientes_guardar", datosCliente).then((response)=>{
                      this.cliente = {};
                      this.listar_cliente();
                      this.nuevoCliente();
                    }).catch((error)=>{
                      console.log(error.response);
                    })
              }
            },
            listar_cliente(){
                axios.get("/clientes_listar").then((response)=>{
                    this.lista_clientes = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
            },
            editar_cliente(param_cliente){
               this.editando = true;
               this.cliente = param_cliente;
               this.nuevoCliente();
            },
            eliminar_cliente(){
                axios.delete("/clientes_eliminar/"+this.cliente.id).then((response)=>{
                  this.cliente = {};
                  $("#eliminacionCliente").modal("toggle");
                  this.lista_clientes = response;
                  
                }).catch((error)=>{
                  console.log(error.response);
                })
                this.listar_cliente();
            },nuevoCliente(){
              $("#formulario").modal("toggle");
            }, eliminarCliente(param_cliente){
              $("#eliminacionCliente").modal("toggle");
              this.cliente = param_cliente;
            }, cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.cliente = {};
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
