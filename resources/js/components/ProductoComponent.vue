<template>
    <div class="container">
        <div class="row">
            <div v-if="vista==0" class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a @click="nuevoProducto()" class="btn btn-success mb-1">
                            <i class="fas fa-plus"></i>
                            Nuevo</a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <select v-model="criterio" class="form-control">
                                                        
                                <option value="producto.nombre">Nombre</option>
                                <option value="categoria.nombre">Categoria</option>
                                
                            </select>
                            <input v-model="buscar" type="text" class="form-control" @input="buscarProducto()">
                            <button class="btn btn-primary">
                                <i class="fas fa-search"></i>
                            </button>
                        </div>
                    </div>
                </div>

                <div class="table-responsive ">
                    <table class="table mb-0 table-bordered">

                        <thead class="bg-dark text-white">
                            <tr class="text-white">
                                <th class="text-white">#</th>
                                <th class="text-white">Nombre</th>
                                <th class="text-white">Tamaño</th>
                                <th class="text-white">Precio</th>
                                <th class="text-white">Categoria</th>
                            
                                <th class="text-white">Estado</th>
                                <th class="text-white">Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in lista_productos" :key="index">
                                <td>{{ item.id_producto }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.tamanio }}</td>
                                <td>{{ item.precio }}</td>
                                <td>{{ item.categoria }}</td>
                      
                                <td>
                                    <span v-if="item.estado==0"
                                        class="badge text-bg-primary">Activo</span>
                                    <span v-else class="badge text-bg-dark">Inactivo</span>
                                </td>
                                <td>
                                    <a @click="editando(item)" class="btn btn-primary text-white btn-sm mx-1">Editar</a>
                                    <a v-if="item.estado==0" @click="desactivarProducto(item)" class="btn btn-danger text-white btn-sm">Desactivar</a>
                                    <a v-else @click="activarProducto(item)" class="btn btn-success text-white btn-sm">Activar</a>

                                </td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>


            <div v-if="vista==1" class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <a @click="regresarTabla()" class="btn btn-danger mb-1">
                            <i class="fas fa-arrow-left"></i>
                            Regresar
                        </a>
                    </div>
                </div>

                <div class="card">
                    <div class="card-body">

                        <h4 class="card-title mb-2">Ingrese datos del producto</h4>
                        
                        <!-- end row -->
                        <div class="row mb-3 pt-2">
                            <label  for="nombres" class="col-sm-2 col-form-label">Nombre</label>
                            <div class="col-sm-10">
                                <input v-model="producto.nombre" class="form-control" type="text" 
                                    id="nombres">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label  for="tamanio" class="col-sm-2 col-form-label">Tamaño</label>
                            <div class="col-sm-10">
                                <input v-model="producto.tamanio" class="form-control" type="text" 
                                    id="tamanio">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label  for="precio" class="col-sm-2 col-form-label">Precio</label>
                            <div class="col-sm-10">
                                <input v-model="producto.precio" class="form-control" type="text" 
                                    id="precio">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label  for="precio" class="col-sm-2 col-form-label">Categorias</label>
                            <div class="col-sm-10">
                                <select v-model="producto.id_categoria" class="form-control">
                                    <option value="0" selected hidden disabled>Seleccione categoria</option>
                                    <option v-for="(item, index) in lista_categorias" :key="index" :value="item.id_categoria" v-text="item.nombre"></option>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a v-if="accion=='guardando'" @click="guardarProducto()" class="btn btn-success mb-1">
                                <i class="fas fa-save"></i>
                                Guardar
                            </a>
                            <a v-else-if="accion=='editando'" @click="modificarProducto()" class="btn btn-success mb-1">
                                <i class="fas fa-save"></i>
                                Modificar
                            </a>
                        </div>
                        
                        <!-- end row -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    import Swal from 'sweetalert2'
    export default {
        data() {
            return {
                criterio:'producto.nombre',
                buscar:'',
                vista: 0,
                accion:'guardando',
                lista_productos: [],
                producto: {
                    id_producto: 0,
                    nombre: '',
                    tamanio: '',
                    precio: 0,
                    id_categoria: 0,
                    
                }
            }
        },

        methods: {
            getCategorias() {
                axios.get('/get_categorias?criterio=categoria.nombre').then((response) => {
                        console.log(response.table);
                        this.lista_categorias = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },
            buscarProducto(){
                this.getProductos();
            },
            editando(item){
                
                this.accion = 'editando';
                this.vista = 1;
                this.producto.id_producto=item.id_producto;
                this.producto.nombre=item.nombre;
                this.producto.tamanio=item.tamanio;
                this.producto.precio=item.precio;
                this.producto.id_categoria=item.id_categoria;
                
                
            },
            activarProducto(item){
                
                axios.post('/activar_producto', {'id_producto':item.id_producto}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Producto activada con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getProductos();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            desactivarProducto(item){
                
                axios.post('/desactivar_producto', {'id_producto':item.id_producto}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Producto desactivado con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getProductos();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            guardarProducto(){
                axios.post('/guardar_producto', this.producto).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Producto guardado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                       
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getProductos();
                        this.regresarTabla();
                    })
            },
            modificarProducto(){
                axios.post('/modificar_producto', this.producto).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Producto modificado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getProductos();
                        this.regresarTabla();
                    })
            },
            regresarTabla() {
                this.vista = 0;
            },
            nuevoProducto() {
                this.vista = 1;
                this.accion = 'guardando';
                this.producto.nombre='';
                this.producto.tamanio='';
                this.producto.precio='';
                this.producto.id_categoria=0;
                this.getCategorias();
            },
            getProductos() {
                axios.get('/get_productos?criterio='+this.criterio+'&buscar='+this.buscar).then((response) => {
                        console.log(response.table);
                        this.lista_productos = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },
        },

        mounted() {
            console.log('Component mounted.');
            this.getCategorias();
            this.getProductos();
        }
    }

</script>
