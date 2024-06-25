<template>
    <div class="container">
        <div class="row">
            <div v-if="vista==0" class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a @click="nuevoCliente()" class="btn btn-success mb-1">
                            <i class="fas fa-plus"></i>
                            Nuevo</a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <select v-model="criterio" class="form-control">
                                                        
                                <option value="cliente.nombre">Nombre</option>
                                <option value="cliente.apellidos">Apellidos</option>
                            </select>
                            <input v-model="buscar" type="text" class="form-control" @input="buscarCliente()">
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
                                <th class="text-white">Apellidos</th>
                                <!-- <th class="text-white">Empresa</th> -->
                                <th class="text-white">Telefono</th>
                                <th class="text-white">Direccion</th>
                                <th class="text-white">Estado</th>
                                <th class="text-white">Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in lista_clientes" :key="index">
                                <td>{{ item.id_cliente }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.apellidos }}</td>
                                <!-- <td>{{ item.empresa }}</td> -->
                                <td>{{ item.telefono }}</td>
                                <td>{{ item.direccion }}</td>
                                <td>
                                    <span v-if="item.estado==0"
                                        class="badge text-bg-primary">Activo</span>
                                    <span v-else class="badge text-bg-dark">Inactivo</span>
                                </td>
                                <td>
                                    <a @click="editando(item)" class="btn btn-primary text-white btn-sm mx-1">Editar</a>
                                    <a v-if="item.estado==0" @click="desactivarCliente(item)" class="btn btn-danger text-white btn-sm">Desactivar</a>
                                    <a v-else @click="activarCliente(item)" class="btn btn-success text-white btn-sm">Activar</a>

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

                        <h4 class="card-title mb-2">Ingrese datos del cliente</h4>
                        
                        <!-- end row -->
                        <div class="row mb-3 pt-2">
                            <label  for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                            <div class="col-sm-10">
                                <input v-model="cliente.nombre" class="form-control" type="text" 
                                    id="nombres">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                            <div class="col-sm-10">
                                <input v-model="cliente.apellidos" class="form-control" type="text" 
                                    id="apellidos">
                            </div>
                        </div>

                        <!-- <div class="row mb-3 pt-2">
                            <label for="empresa" class="col-sm-2 col-form-label">Empresa</label>
                            <div class="col-sm-10">
                                <input v-model="cliente.empresa" class="form-control" type="text" 
                                    id="empresa">
                            </div>
                        </div> -->

                        <div class="row mb-3 pt-2">
                            <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                            <div class="col-sm-10">
                                <input v-model="cliente.telefono" class="form-control" type="text" 
                                    id="telefono">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                            <div class="col-sm-10">
                                <input v-model="cliente.direccion" class="form-control" type="text" 
                                    id="direccion">
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a v-if="accion=='guardando'" @click="guardarCliente()" class="btn btn-success mb-1">
                                <i class="fas fa-save"></i>
                                Guardar
                            </a>
                            <a v-else-if="accion=='editando'" @click="modificarCliente()" class="btn btn-success mb-1">
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
                criterio:'cliente.nombre',
                buscar:'',
                vista: 0,
                accion:'guardando',
                lista_clientes: [],
                cliente: {
                    id_cliente: 0,
                    nombre: '',
                    apellidos: '',
                    // empresa: '',
                    telefono: '',
                    direccion: '',
                }
            }
        },

        methods: {
            buscarCliente(){
                this.getClientes();
            },
            editando(item){
                
                this.accion = 'editando';
                this.vista = 1;
                this.cliente.id_cliente=item.id_cliente;
                this.cliente.nombre=item.nombre;
                this.cliente.apellidos=item.apellidos;
                // this.cliente.empresa=item.empresa;
                this.cliente.telefono=item.telefono;
                this.cliente.direccion=item.direccion;
                
            },
            activarCliente(item){
                
                axios.post('/activar_cliente', {'id_cliente':item.id_cliente}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Cliente activado con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getClientes();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            desactivarCliente(item){
                
                axios.post('/desactivar_cliente', {'id_cliente':item.id_cliente}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Cliente desactivado con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getClientes();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            guardarCliente(){
                axios.post('/guardar_cliente', this.cliente).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Cliente guardado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                       
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getClientes();
                        this.regresarTabla();
                    })
            },
            modificarCliente(){
                axios.post('/modificar_cliente', this.cliente).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Cliente modificado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getClientes();
                        this.regresarTabla();
                    })
            },
            regresarTabla() {
                this.vista = 0;
            },
            nuevoCliente() {
                this.vista = 1;
                this.accion = 'guardando';
            },
            getClientes() {
                axios.get('/get_clientes?criterio='+this.criterio+'&buscar='+this.buscar).then((response) => {
                        console.log(response.table);
                        this.lista_clientes = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },
        },

        mounted() {
            console.log('Component mounted.');
            this.getClientes();
        }
    }

</script>
