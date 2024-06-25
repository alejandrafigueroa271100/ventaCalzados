<template>
    <main>
        
        <div class="container-fluid">

            
            <!-- <div class="page-content-wrapper"> -->
                <div class="row">
                        <div class="row mb-2">
                            <div class="col-12 text-end">
                                <button @click="abrirModalNuevo()" class="btn btn-success">Nuevo
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                                <!-- <div class="card"> -->
                                    <!-- <div class="card-body"> -->

                                        <div class="table-responsive">
                                            <table class="table mb-0 table-bordered table-hover text-white">
                                                <thead class="bg-dark">
                                                    <tr class="text-white">

                                                        <th class="text-white">Rol</th>
                                                        <th class="text-white">Estado</th>
                                                        <th class="text-white">Opciones</th>

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="" v-for="item in array_roles" :key="item.id">

                                                        <td>{{ item.nombre }}</td>
                                                        <td>
                                                            <span v-if="item.estado==1"
                                                                class="badge text-bg-primary">Activo</span>
                                                            <span v-else class="badge text-bg-dark">Inactivo</span>
                                                        </td>
                                                        <td>
                                                            <a @click="editarRol(item)" class="btn btn-primary text-white btn-sm mx-1">Editar</a>
                                                            <a v-if="item.estado==0" @click="desactivar(item)" class="btn btn-danger text-white btn-sm">Desactivar</a>
                                                            <a v-else @click="activar(item)" class="btn btn-success text-white btn-sm">Activar</a>

                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                    <!-- </div> -->
                                    <!-- End Cardbody -->
                                <!-- </div> -->
                                <!-- End Card -->
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                    </div>
                <!-- </div> -->

                <!-- end page-content-wrapper-->

        </div>
            <!-- Container-fluid -->
        

        <!-- modal nuevo rol -->
        <div class="modal fade" id="nuevoRol" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 v-if="rol.accion==0" class="modal-title fs-5" id="exampleModalLabel">Registro nuevo rol de usuario</h1>
                        <h1 v-if="rol.accion==1" class="modal-title fs-5" id="exampleModalLabel">Modificar rol de usuario</h1>
                        <button @click="cerrarModalNuevo()" type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group mb-2">
                            <label for="nombre">Nombre</label>
                            <input v-model="rol.nombre" type="text" class="form-control" id="nombre">
                        </div>
                        <label for="">Permisos</label>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>

                                                <th>Permisos</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-danger" v-for="item in lista_roles" :key="item.id">

                                                <td>{{ item.descripcion }}</td>
                                                <td>
                                                    <a @click="agregarPermiso(item)" class="btn btn-primary">
                                                        <i class="fas fa-arrow-right"></i>
                                                    </a>
                                                </td>

                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="table-responsive">
                                    <table class="table mb-0">
                                        <thead>
                                            <tr>

                                                <th>Permisos a registrar</th>
                                                <th></th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr class="table-success" v-for="item in lista_roles_agregar"
                                                :key="item.id">

                                                <td>{{ item.descripcion }}</td>
                                                <td>
                                                    <a @click="quitarPermiso(item)" class="btn btn-warning">
                                                        <i class="fas fa-times"></i>
                                                    </a>
                                                </td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button @click="cerrarModalNuevo()" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Cerrar</button>
                        <button :disabled="guardando_rol" v-if="rol.accion==0" @click="guardarRol()" type="button" class="btn btn-primary">Guardar</button>
                        <button v-if="rol.accion==1" @click="modificarRol()" type="button" class="btn btn-primary">Modificar</button>
                    </div>
                </div>
            </div>
        </div>

        <!-- Elemento donde se mostrará el toast -->
        <div class="position-fixed top-0 end-0 toast" style="z-index: 1050" ref="miToast" role="alert"
            aria-live="assertive" aria-atomic="true" data-bs-autohide="true" data-bs-delay="2000">
            <div class="toast-header bg-danger" style="border:none">
                <strong class="me-auto text-white">{{ mensajeError }}</strong>
                <button type="button" class="btn btn-danger text-white" @click="cerrarToastError()" aria-label="Cerrar">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        </div>
    </main>

    <!-- End Page-content -->
</template>

<script>
    import axios from 'axios';
    import Swal from 'sweetalert2'

    export default {
        data() {
            return {
                guardando_rol:false,
                lista_roles: [],
                lista_roles_agregar: [],
                array_roles: [],
                rol: {
                    id_rol: 0,
                    nombre: '',
                    estado: 1,
                    accion:0,
                },
                mensajeError: '',


            }
        },
        methods: {
            abrirModalNuevo() {
                $('#nuevoRol').modal('show');
                this.lista_roles_agregar = [];
                this.rol.nombre = '';
                this.rol.accion=0;
                this.getRoles();
            },
            activar(rol){
                axios.get('/activar_rol?id_rol='+rol.id).then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getArrayRoles();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Operación exitosa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
            },  
            desactivar(rol){
                axios.get('/desactivar_rol?id_rol='+rol.id).then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{

                        this.getArrayRoles();
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Operación exitosa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                    })
            },
            getRoles() {
                axios.get('/get_permisos').then((response) => {
                        this.lista_roles = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    
            },

            getArrayRoles() {
                axios.get('/get_roles').then((response) => {
                        this.array_roles = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },

            cerrarModalNuevo() {
                $('#nuevoRol').modal('hide');
            },
            agregarPermiso(permiso) {
                let indice = this.lista_roles_agregar.findIndex((elemento) => elemento.id === permiso.id);
                if (indice !== -1) {
                    // alert('el permiso ya esta agregado');
                    this.mostrarToastError('el permiso ya esta agregado');
                } else {
                    this.lista_roles_agregar.push(permiso);
                }
            },
            quitarPermiso(permiso) {
                // Encuentra el índice del objeto a eliminar en el array
                let indice = this.lista_roles_agregar.findIndex((elemento) => elemento.id === permiso.id);

                // Si el objeto existe en el array, elimínalo
                if (indice !== -1) {
                    this.lista_roles_agregar.splice(indice, 1);
                }
            },
            mostrarToastError(mensaje) {
                var miToast = new bootstrap.Toast(this.$refs.miToast);
                this.mensajeError = mensaje;
                miToast.show();
            },
            cerrarToastError() {
                var miToast = new bootstrap.Toast(this.$refs.miToast);
                miToast.hide();
            },
            guardarRol() {
                this.guardando_rol=true;
                let url = "/save_rol"
                this.rol.permisos = this.lista_roles_agregar;
                if (this.rol.nombre == '') {
                    this.mostrarToastError('Falta el nombre del rol');
                    this.guardando_rol=false;

                } 
                else{
                    if(this.lista_roles_agregar.length==0){
                        this.mostrarToastError('Debe agregar al menos un permiso');
                        this.guardando_rol=false;
                    }
                    else {
                        axios.post(url, this.rol).then((response) => {
                                console.log(response);
                            })
                            .catch((error) => {
                                console.log(error.message)
                            })
                            .finally(()=>{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Operación exitosa',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#nuevoRol').modal('hide');
                                this.getArrayRoles();
                                this.guardando_rol=false;
                            })
                    }
                }
            },
            modificarRol() {
                let url = "/modify_rol"
                this.rol.permisos = this.lista_roles_agregar;
                if (this.rol.nombre == '') {
                    this.mostrarToastError('Falta el nombre del rol');
                } 
                else{
                    if(this.lista_roles_agregar.length==0){
                        this.mostrarToastError('Debe agregar al menos un permiso');
                        
                    }
                    else {
                        axios.post(url, this.rol).then((response) => {
                                console.log(response);
                            })
                            .catch((error) => {
                                console.log(error.message)
                            })
                            .finally(()=>{
                                Swal.fire({
                                    position: 'top-end',
                                    icon: 'success',
                                    title: 'Operación exitosa',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                                $('#nuevoRol').modal('hide');
                                this.getArrayRoles();
    
                            })
                    }
                }
            },
            editarRol(item) {
                this.rol.accion=1;
                this.rol.nombre = item.nombre;
                this.rol.estado = item.estado;
                this.rol.id_rol = item.id;
                // recuperando permisos
                axios.get('/get_permisos_rol?id_rol=' + this.rol.id_rol).then((response) => {
                        this.lista_roles_agregar = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(()=>{
                        this.getRoles();
                        $('#nuevoRol').modal('show');
                    })
            },





        },
        mounted() {
            console.log('Component mounted.');
            this.getArrayRoles();
        }


    }

</script>
