import './bootstrap';
import { createApp } from 'vue';



/**
 * Next, we will create a fresh Vue application instance. You may then begin
 * registering components with the application instance so they are ready
 * to use in your application's views. An example is included for you.
 */

const app = createApp({});

import ExampleComponent from './components/ClienteComponent.vue';
import CategoriaComponent from './components/CategoriaComponent.vue';
import EmpleadoComponent from './components/EmpleadoComponent.vue';
import ProductoComponent from './components/ProductoComponent.vue';
import UsuarioComponent from './components/UsuarioComponent.vue';
import RolComponent from './components/RolComponent.vue';


app.component('cliente-component', ExampleComponent);
app.component('categoria-component', CategoriaComponent);
app.component('empleado-component', EmpleadoComponent);
app.component('producto-component', ProductoComponent);
app.component('usuario-component', UsuarioComponent);
app.component('rol-component', RolComponent);
/**
 * The following block of code may be used to automatically register your
 * Vue components. It will recursively scan this directory for the Vue
 * components and automatically register them with their "basename".
 *
 * Eg. ./components/ExampleComponent.vue -> <example-component></example-component>
 */

// Object.entries(import.meta.glob('./**/*.vue', { eager: true })).forEach(([path, definition]) => {
//     app.component(path.split('/').pop().replace(/\.\w+$/, ''), definition.default);
// });

/**
 * Finally, we will attach the application instance to a HTML element with
 * an "id" attribute of "app". This element is included with the "auth"
 * scaffolding. Otherwise, you will need to add an element yourself.
 */

app.mount('#app');
