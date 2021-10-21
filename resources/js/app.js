/**
 * First we will load all of this project's JavaScript dependencies which
 * includes Vue and other libraries. It is a great starting point when
 * building robust, powerful web applications using Vue and Laravel.
 */

require('./bootstrap');

window.Vue = require('vue').default;

/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// const files = require.context('./', true, /\.vue$/i)
// files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default))

Vue.component('example-component', require('./components/ExampleComponent.vue').default);
Vue.component('alimentos-component', require("./components/Alimentos.Component.vue").default);
Vue.component('clientes-component', require("./components/Clientes.Component.vue").default);
Vue.component('direccion-component', require("./components/DireccionComponent.vue").default);
Vue.component('usuarios-component', require("./components/UsuariosComponent.vue").default);
Vue.component('direccionesNegocio-component', require("./components/DireccionesNegocioComponent.vue").default);
Vue.component('datosNegocio-component', require("./components/DatosNegocioComponent.vue").default);
Vue.component('regist-component', require("./components/RegistroDualComponent.vue").default);
Vue.component('inicio-component', require("./components/InicioComponent.vue").default);
Vue.component('profile-component', require("./components/ProfileComponent.vue").default);
Vue.component('carrito-component', require("./components/CarritoComponent.vue").default);
Vue.component('pago-component', require("./components/PagosTarjetaComponent.vue").default);
Vue.component('pedidos-component', require("./components/PedidosComponent.vue").default);

/**
 * Next, we will create a fresh Vue application instance and attach it to
 * the page. Then, you may begin adding components to this application
 * or customize the JavaScript scaffolding to fit your unique needs.
 */

const app = new Vue({
    el: '#app_uttec',
});
