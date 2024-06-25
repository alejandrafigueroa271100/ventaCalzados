<template>
    <div class="container">
        <div class="row">
            <div v-if="vista==0" class="col-md-12">
                <div class="row">
                    <div class="col-md-12 text-end">
                        <a @click="nuevoEmpleado()" class="btn btn-success mb-1">
                            <i class="fas fa-plus"></i>
                            Nuevo</a>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-8">
                        <div class="input-group">
                            <select v-model="criterio" class="form-control">
                                                        
                                <option value="empleado.nombre">Nombre</option>
                                <option value="empleado.apellidos">Apellidos</option>
                            </select>
                            <input v-model="buscar" type="text" class="form-control" @input="buscarEmpleado()">
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
                                <th class="text-white">Telefono</th>
                                <th class="text-white">Direccion</th>
                                <th class="text-white">Sueldo</th>
                                <th class="text-white">Estado</th>
                                <th class="text-white">Opcion</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(item, index) in lista_empleados" :key="index">
                                <td>{{ item.id_empleado }}</td>
                                <td>{{ item.nombre }}</td>
                                <td>{{ item.apellidos }}</td>
                                <td>{{ item.telefono }}</td>
                                <td>{{ item.direccion }}</td>
                                <td>{{ item.sueldo }}</td>
                                <td>
                                    <span v-if="item.estado==0"
                                        class="badge text-bg-primary">Activo</span>
                                    <span v-else class="badge text-bg-dark">Inactivo</span>
                                </td>
                                <td>
                                    <a @click="editando(item)" class="btn btn-primary text-white btn-sm mx-1">Editar</a>
                                    <a v-if="item.estado==0" @click="desactivarEmpleado(item)" class="btn btn-danger text-white btn-sm">Desactivar</a>
                                    <a v-else @click="activarEmpleado(item)" class="btn btn-success text-white btn-sm">Activar</a>

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

                        <h4 class="card-title mb-2">Ingrese datos del empleado</h4>
                        
                        <!-- end row -->
                        <div class="row mb-3 pt-2">
                            <label  for="nombres" class="col-sm-2 col-form-label">Nombres</label>
                            <div class="col-sm-10">
                                <input v-model="empleado.nombre" class="form-control" type="text" 
                                    id="nombres">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label for="apellidos" class="col-sm-2 col-form-label">Apellidos</label>
                            <div class="col-sm-10">
                                <input v-model="empleado.apellidos" class="form-control" type="text" 
                                    id="apellidos">
                            </div>
                        </div>

                    
                        <div class="row mb-3 pt-2">
                            <label for="telefono" class="col-sm-2 col-form-label">Telefono</label>
                            <div class="col-sm-10">
                                <input v-model="empleado.telefono" class="form-control" type="text" 
                                    id="telefono">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label for="direccion" class="col-sm-2 col-form-label">Direccion</label>
                            <div class="col-sm-10">
                                <input v-model="empleado.direccion" class="form-control" type="text" 
                                    id="direccion">
                            </div>
                        </div>

                        <div class="row mb-3 pt-2">
                            <label for="sueldo" class="col-sm-2 col-form-label">sueldo</label>
                            <div class="col-sm-10">
                                <input v-model="empleado.sueldo" class="form-control" type="number" 
                                    id="sueldo">
                            </div>
                        </div>

                        <div class="col-md-12 text-center">
                            <a v-if="accion=='guardando'" @click="guardarEmpleado()" class="btn btn-success mb-1">
                                <i class="fas fa-save"></i>
                                Guardar
                            </a>
                            <a v-else-if="accion=='editando'" @click="modificarEmpleado()" class="btn btn-success mb-1">
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
                criterio:'empleado.nombre',
                buscar:'',
                vista: 0,
                accion:'guardando',
                lista_empleados: [],
                empleado: {
                    id_empleado: 0,
                    nombre: '',
                    apellidos: '',
                    telefono: '',
                    direccion: '',
                    sueldo: 0,
                }
            }
        },

        methods: {
            buscarEmpleado(){
                this.getEmpleados();
            },
            editando(item){
                
                this.accion = 'editando';
                this.vista = 1;
                this.empleado.id_empleado=item.id_empleado;
                this.empleado.nombre=item.nombre;
                this.empleado.apellidos=item.apellidos;
                this.empleado.empresa=item.empresa;
                this.empleado.telefono=item.telefono;
                this.empleado.direccion=item.direccion;
                this.empleado.sueldo=item.sueldo;
                
            },
            activarEmpleado(item){
                
                axios.post('/activar_empleado', {'id_empleado':item.id_empleado}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Empleado activado con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getEmpleados();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            desactivarEmpleado(item){
                
                axios.post('/desactivar_empleado', {'id_empleado':item.id_empleado}).then(()=>{
                    Swal.fire({
                        title: 'Operación exitosa',
                        text: 'Empleado desactivado con exito',
                        icon: 'success',
                        confirmButtonText: 'Ok',
                        timer:1500,

                    });
                    this.getEmpleados();

                }).catch((error)=>{
                    console.log(error.message);
                })
            },
            guardarEmpleado(){
                axios.post('/guardar_empleado', this.empleado).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Empleado guardado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                       
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getEmpleados();
                        this.regresarTabla();
                    })
            },
            modificarEmpleado(){
                axios.post('/modificar_empleado', this.empleado).then((response) => {
                        console.log(response.table);
                        Swal.fire({
                            title: 'Operación exitosa',
                            text: 'Empleado modificado con exito',
                            icon: 'success',
                            confirmButtonText: 'Ok',
                            timer:1500,
                        });
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getEmpleados();
                        this.regresarTabla();
                    })
            },
            regresarTabla() {
                this.vista = 0;
            },
            nuevoEmpleado() {
                this.vista = 1;
                this.accion = 'guardando';
            },
            getEmpleados() {
                axios.get('/get_empleados?criterio='+this.criterio+'&buscar='+this.buscar).then((response) => {
                        console.log(response.table);
                        this.lista_empleados = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },
        },

        mounted() {
            console.log('Component mounted.');
            this.getEmpleados();
        }
    }

</script>
