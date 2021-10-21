<template>
    <div>

                    <div class="header pb-8 pt-5 pt-lg-8 d-flex align-items-center" style="background-image: url(&quot;../argon/img/theme/profile-cover.jpg&quot;); background-size: cover; background-position: center top;"><span class="mask bg-gradient-default opacity-8"></span> <div class="container-fluid d-flex align-items-center"><div class="row"><div class="col-md-12 col-lg-7"><h1 class="display-2 text-white">Bienvenido!</h1> <p class="text-white mt-0 mb-5">Esta es tu página de productos. Puede ver los productos guardarlos y pedirlos.</p></div></div></div></div>


                <div class="card bg-secondary shadow">
                        <div class="card-header bg-white border-0">
                            <div class="row align-items-center">
                                <h3 class="mb-0">&nbsp;Productos</h3>
                            </div>
                        </div>
                        <paginate name="var_item" :per=10 :list="list_items" class="card-body">
                        <div  v-for="v_item in paginated('var_item')">
                            <form method="post" autocomplete="off">
                                <div class="pl-lg-4">
                                    <div>
                                    <div role="alert"  class="alert alert-secondary" >
                                     <a href="#" class="avatar avatar-sm" data-toggle="tooltip" data-original-title="Romina Hadid">
                                                <img alt="Image placeholder" :src="'/storage/'+v_item.foto">
                                    </a>
                                        <strong>{{v_item.nombre}}</strong><br>
                                        <b>Cantidad:</b> {{v_item.cantidad}}<br>
                                        <b>Precio Unitario:</b> ${{ around(v_item.precio)}}MXN<br>
                                        <b>precio Total:</b> ${{around(v_item.precioTotal)}}MXN
                                        <button type="button"  aria-label="Close" class="close" @click="eliminarAlimento(v_item)">
                                            <span aria-hidden="true">×</span>
                                        </button>
                                    </div>
                                    <hr class="my-4">
                                    </div>


                                </div>
                            </form>
                            </div>
                            <div class="card-footer py-4">
                                <div class="col-4 align-self-end">
                                <h1>Total: ${{around(this.total[0].precioTotal)}} MXN</h1>

                                <a v-bind:href="'/pagos'" class="btn btn-success">Pagar</a>
                                </div>
                            </div>

                        </paginate>
                          <nav aria-label="...">
                              <paginate-links for="var_item" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                          </nav>
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

    </div>
</template>
<script>
    import VuePaginate from "vue-paginate";
    export default {
        mounted(){
            this.items();
            this.ftotal();
        },data(){
            return {
                list_items: {},
                paginate: ['var_item'],
                unique_item: {},
                total: 0
            }
        },methods:{
            items(){
                axios.get('/items').then((response)=>{
                    this.list_items = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            }, around(value){
                return parseFloat(Math.round(value)).toFixed(1);
            },ftotal(){
                axios.get('/total').then((response)=>{
                    this.total = response.data;
                }).catch((error)=>{
                    console.log(error.response);
                })
            }, eliminarAlimento(param_negocio){
              $("#eliminacionAlimento").modal("toggle");
              this.unique_item = param_negocio;
            },eliminar_alimento(){
                axios.delete("/deleteItem/"+this.unique_item.id_item).then((response)=>{
                  this.list_items = response;
                  this.unique_item = {};
                    this.ftotal();
                  $("#eliminacionAlimento").modal("toggle");
                }).catch((error)=>{
                  console.log(error.response);
                })
                this.items();
            }
        }
    }
</script>
