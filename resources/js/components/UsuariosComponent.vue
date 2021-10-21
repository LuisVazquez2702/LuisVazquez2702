<template>
<div>
    <form>
                  <div class="header bg-gradient-primary pt-5 pt-nd-6">
                  <div class="container-fluid">
                    <div class="header pb-6">
                      <div class="row align-items-center py-4">
                        <div class="col-lg-6 col-7">
                          <h6 class="h2 text-white d-inline-block mb-0">Usuarios</h6>
                          <nav aria-label="breadcrumb" class="d-none d-md-inline-block ml-md-4">
                            <ol class="breadcrumb breadcrumb-links breadcrumb-dark">
                              <li class="breadcrumb-item"><a href="#"><i class="fas fa-home"></i></a></li>
                              <li class="breadcrumb-item"><a v-bind:href="'/inicio'">Inicio</a></li>
                              <li class="breadcrumb-item active" aria-current="page">Usuarios</li>
                            </ol>
                          </nav>
                        </div>
                        <div class="col-lg-6 col-5 text-right">
                          <button type="button" class="btn btn-sm btn-neutral" @click="nuevoUsuario()">Nuevo Usuario</button>
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
                                          <th scope="col" class="sort" data-sort="name">Nombre:</th>
                                          <th scope="col" class="sort" data-sort=""></th>
                                          <th scope="col" class="sort" data-sort="budget">Email:</th>
                                          <th scope="col" class="sort" data-sort="status">Nivel:</th>
                                          <th scope="col"></th>
                                      </tr>
                                  </thead>
                                    <paginate name="var_usuarios" :per="10" :list="lista_usuarios"  tag="tbody" class="list">                  
                                      <tr v-for="v_usuario in paginated('var_usuarios')">
                                          <td class="budget">
                                              {{ v_usuario.name }} 
                                          </td>
                                          <td>
                                            <a href="#" class="avatar avatar-sm" data-toggle="tooltip" @click="abrirFoto(v_usuario.foto)" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+v_usuario.foto">
                                            </a>
                                          </td>
                                          <td>
                                              {{v_usuario.email}}
                                          </td>
                                          <td>
                                              <div v-if="v_usuario.tipo_usuario==1">Administrador</div>
                                              <div v-if="v_usuario.tipo_usuario==2">Negocio</div>
                                              <div v-if="v_usuario.tipo_usuario==3">Cliente</div>

                                          </td>
                                          <td class="text-right">
                                              <div class="dropdown">
                                                  <button class="btn btn-sm btn-icon-only text-light"  role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                    <i class="fas fa-ellipsis-v"></i>
                                                  </button>
                                                  <div class="dropdown-menu dropdown-menu-right dropdown-menu-arrow">
                                                      <button  type="button" class="dropdown-item" @click="editar_usuario(v_usuario)">Modificar</button>
                                                      <button  type="button" class="dropdown-item" @click="eliminarUsuario(v_usuario)">Eliminar</button>
                                                  </div>
                                              </div>
                                          </td>
                                      </tr>
                                    </paginate>
                              </table>
                          </div>
                                    <paginate-links for="var_usuarios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                               
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
                                  <input type="text" class="form-control" id="nombreUsuario" v-model="usuario.name" placeholder="Nombre Completo...">
                                  <br>
                                  <input type="email" class="form-control" id="emailUsuario" v-model="usuario.email" rows="3" placeholder="Email...">
                                  <div v-if="this.editando==false">
                                    <br>
                                    <input type="password" class="form-control" id="passwordUsuario" v-model="usuario.password" placeholder="Password...">
                                    <br>
                                    <input type="password" class="form-control" id="confirmacion" v-model="usuario.confirmacion" placeholder="Confirmación...">
                                    <br>
                                  </div>
                                  <label>Tipo de Usuario:</label>
                                  <select name="select" class="form-control"  v-model="usuario.tipo_usuario">
                                      <option  :value="1" >Administrador</option>
                                      <option  :value="2" >Negocio</option>  
                                      <option  :value="3" >Cliente</option>                       
                                  </select>
                                  <br>
                                  <input type="file" class="form-control" id="foto"  accept="image/*" @change="subirFoto">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" @click="cerrarModal">Cerrar</button>
                      <button type="button" class="btn btn-primary" @click="guardarUsuario">Guardar</button>
                    </div>
                  </div>
                </div>
              </div>

              <div class="modal fade" id="eliminacionUsuario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                      <button type="button" class="btn btn-primary" @click="eliminar_usuario()" id="botoncito">Eliminar</button>
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
            this.listar_usuarios();
            this.usuarioEspec();
        }
        ,data(){
            return {
                usuario: {},
                lista_usuarios: {},
                editando:false,
                ruta : '',
                paginate: ['var_usuarios'],
                confirmacion: '',
                logeado: {},
            }
        },methods:{
            subirFoto(e){
                this.usuario.foto = e.target.files[0];
            },
            guardarUsuario(){
                if(this.usuario.password==this.usuario.confirmacion){
                    
                        const datosUsuario = new FormData;
                        datosUsuario.set('name',this.usuario.name);
                        datosUsuario.set('email',this.usuario.email);
                        datosUsuario.set('password',this.usuario.password);
                        datosUsuario.set('tipo_usuario',this.usuario.tipo_usuario);                
                        datosUsuario.set('foto',this.usuario.foto);
                        
                        if(this.editando){
                        datosUsuario.set('id',this.usuario.id);
                        axios.post('/usuarios_editar',datosUsuario)
                            .then((response) => {
                            this.usuario = {};
                            this.listar_usuarios();
                            this.nuevoUsuario();
                            })
                            .catch((error)=>{
                                console.log(error.response);
                            })
                        }else{
                            axios.post('/usuarios_guardar',datosUsuario)
                            .then((response) => {
                            this.usuario = {};
                            this.listar_usuarios();
                            this.nuevoUsuario();
                            })
                            .catch((error)=>{
                                console.log(error.response);
                            })
                        }
                        
                }else{
                    alert("Las contraseñas no coinciden")
                }
            },
            usuarioEspec(){
                axios.get('/usuarioEspec')
                .then((response) => {
                    this.logeado = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            listar_usuarios(){
                axios.get('/usuarios_listar')
                .then((response) => {
                    this.lista_usuarios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
            },
            editar_usuario(param_usuario){
              this.editando = true;
              this.usuario = param_usuario;
              this.confirmacion = this.usuario.password;
              this.nuevoUsuario();
            },
            eliminar_usuario(){
               axios.delete('/usuarios_eliminar/'+this.usuario.id)
              .then((response) => {
                    this.lista_usuarios = response;
                    this.usuario = {};
                    $("#eliminacionUsuario").modal("toggle");
                })
                .catch((error)=>{
                    console.log(error.response);
                });
                this.listar_usuarios();   
            },nuevoUsuario(){
              $("#formulario").modal("toggle");
            }, eliminarUsuario(param_usuario){
              $("#eliminacionUsuario").modal("toggle");
              this.usuario = param_usuario;
            }, cerrarModal(){              
              $("#formulario").modal("toggle");
              this.editando=false;
              this.usuario = {};
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
