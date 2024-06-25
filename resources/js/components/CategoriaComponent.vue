<template>
    <div class="container">
        <div class="row">
            <div v-if="vista==0" class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a @click="nuevaCategoria()" class="btn btn-success mb-1">
                            <i class="fas fa-plus"></i>
                            Nuevo</a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <select v-model="criterio" class="form-control">
                                                        
                                <option value="categoria.nombre">Nombre</option>
                                
                            </select>
                            <input v-model="buscar" type="text" class="form-control" @input="buscarCategoria()">
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
                            
                                <th class="text-white">Estado</th>
                                <th class="text-white">Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in lista_categorias" :key="index">
                                <td>{{ item.id_categoria }}</td>
                                <td>{{ item.nombre }}</td>
                      
                                <td>
                                    <span v-if="item.estado==0"
                                        class="badge text-bg-primary">Activo</span>
                                    <span v-else class="badge text-bg-dark">Inactivo</span>
                                </td>
                                <td>
                                    <a @click="editando(item)" class="btn btn-primary text-white btn-sm mx-1">Editar</a>
                                    <a v-if="item.estado==0" @click="desactivarCategoria(item)" class="btn btn-danger text-white btn-sm">Desactivar</a>
                                    <a v-else @click="activarCategoria(item)" class="btn btn-success text-white btn-sm">Activar</a>

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

                        <h4 class="card-title mb-2">Ingrese datos de la categoria</h4>
                        
                        <!-- end row -->
                        <div class="row mb-3 pt-2">
                            <label  for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                            <div class="col-sm-10">
                                <input v-model="categoria.nombre" class="form-control" type="text" 
                                    id="nombres">
                            </div>
                        </div>

                        

                        <div class="col-md-12 text-center">
                            <a v-if="accion=='guardando'" @click="guardarCategoria()" class="btn btn-success mb-1">
                                <i class="fas fa-save"></i>
                                Guardar
                            </a>
                            <a v-else-if="accion=='editando'" @click="modificarCategoria()" class="btn btn-success mb-1">
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
                criterio:'categoria.nombre',
                buscar:'',
                vista: 0,
                accion:'guardando',
                lista_categorias: [],
                categoria: {
                    id_categoria: 0,
                    nombre: '',
                    
                }
            }
        },

        methods: {
            buscarCategoria(){
                this.getCategorias();
            },
            editando(item){
                
                this.accion = 'editando';
                this.vista = 1;
                this.categoria.id_categoria=item.id_categoria;
                this.categoria.nombre=item.nombre;
                
                
            },
            activarCategoria(item){
                
                axios.post('/activar_categoria', {'id_categoria':item.id_categoria}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Categoria activada con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getCategorias();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            desactivarCategoria(item){
                
                axios.post('/desactivar_categoria', {'id_categoria':item.id_categoria}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Categoria desactivado con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getCategorias();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            guardarCategoria(){
                axios.post('/guardar_categoria', this.categoria).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Categoria guardado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                       
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getCategorias();
                        this.regresarTabla();
                    })
            },
            modificarCategoria(){
                axios.post('/modificar_categoria', this.categoria).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Categoria modificado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getCategorias();
                        this.regresarTabla();
                    })
            },
            regresarTabla() {
                this.vista = 0;
            },
            nuevaCategoria() {
                this.vista = 1;
                this.accion = 'guardando';
                this.categoria.nombre='';
            },
            getCategorias() {
                axios.get('/get_categorias?criterio='+this.criterio+'&buscar='+this.buscar).then((response) => {
                        console.log(response.table);
                        this.lista_categorias = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },
        },

        mounted() {
            console.log('Component mounted.');
            this.getCategorias();
        }
    }

</script>
