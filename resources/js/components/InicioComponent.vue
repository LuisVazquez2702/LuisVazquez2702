<template>
    <div>

        <form>
                  <!--<div class="header bg-gradient-primary pt-5 pt-nd-6">
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
                </div>-->
                <div class="header pt-6 pt-nd-9 pb-9" style="background-image: url('/storage/inicio/35780.jpg');" >

                <center><br><br><br><a><img src="/storage/inicio/name.png"></a></center>
                </div>
                <div class="container-fluid mt--6">
                        <h2>Hasta la Comodidad de tu Casa:</h2>
                        <paginate name="var_alimentos" :per="3" :list="alimentos" tag="div" class="card-deck">
                            <div class="card" v-for="alimento in paginated('var_alimentos')">
                                <img class="card-img-top" :src="'/storage/'+alimento.foto" alt="Card image cap">
                                <div class="card-body">
                                <h4 class="card-title">{{alimento.nombre}}</h4>
                                <p class="card-text">{{alimento.descripcion}}</p>
                                <p class="card-text">{{alimento.nego_name}}</p>
                                <p class="card-text"><small class="text-muted">{{alimento.porcion}}</small></p>

                                <p class="card-text">$ {{around(alimento.precio)}} MXN</p>Cantidad: <input v-model="alimento.cantidad" min="1" type="number" class="form-control" style="width: 20%;"><br>&nbsp;&nbsp;<a href="#" class="btn btn-primary" @click="cargaItem(alimento)">Agregar al Carrito</a>
                                </div>
                            </div>
                        </paginate>
                        <nav aria-label="...">
                              <paginate-links for="var_alimentos" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                        </nav>

                    <h2>Nuestros Socios:</h2>
                    <paginate name="var_negocios" :per="4" :list="negocios" tag="div" class="card-deck">
                            <div class="card" v-for="negocio in paginated('var_negocios')">
                                <img class="card-img-top" :src="'/storage/'+negocio.foto" alt="Card image cap">
                                <div class="card-body">
                                <h5 class="card-title">{{negocio.nombre}}</h5>
                                <p class="card-text">{{negocio.descripcion}}</p>
                                <p class="card-text"><small class="text-muted">Telefono: {{negocio.telefono}}</small></p>
                                <a href="#" class="btn btn-primary">Ver mas...</a>
                                </div>
                            </div>
                    </paginate>
                    <nav aria-label="...">
                            <paginate-links for="var_negocios" :classes="{'ul': ['pagination','justify-content-end','nb-0'], 'li': 'page-item', 'a':'page-link'}"></paginate-links>
                    </nav>
                </div>
        </form>
    </div>

</template>
<script>
import VuePaginate from "vue-paginate";
export default {

    mounted(){
        console.log("Component mounted.")
        this.listar_alimentos();
        this.listar_negocios();
    }, data(){
        return{
            alimentos: {},
            negocios: {},
            paginate: ['var_alimentos', 'var_negocios']
        }
    }, methods:{
        listar_negocios(){
                axios.get('/lista_negocios')
                .then((response) => {
                    this.negocios = response.data;
                })
                .catch((error)=>{
                    console.log(error.response);
                })
        },
        listar_alimentos(){
                axios.get("/alimentos_listar2").then((response)=>{
                    this.alimentos = response.data;
                }).catch((error)=>{
                    console.log(error.response)
                })
        }, cargaItem(alimento){
            axios.post("/newItem", alimento).then((response)=>{

                Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: 'Item Agregado!',
                showConfirmButton: false,
                timer: 1500
                })
                location.reload();
            }).catch((error)=>{
                console.log(error.response);
            })
        }, around(value){
                return parseFloat(Math.round(value)).toFixed(2);
         }
    }
}
</script>
