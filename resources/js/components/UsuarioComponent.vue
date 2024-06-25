<template>
    <main>
        
            <div class="container-fluid">

                <!-- start page title -->
                <!-- end page title -->
                <!-- <div class="page-content-wrapper"> -->
                    <div class="row">
                        <div class="row">
                            <div class="col-12 text-end mb-2">
                                <button @click="abrirModalNuevo()" class="btn btn-success">Nuevo
                                    <i class="fas fa-plus"></i>
                                </button>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12">
                              
                       
                                <div class="table-responsive">
                                            <table class="table mb-4 table-striped table-hover table-bordered">
                                                <thead class="bg-dark text-white text-uppercase">
                                                    <tr>
                                                        <th class="text-white">Usuario</th>
                                                        <!-- <th>Correo</th> -->
                                                        <th class="text-white">Rol</th>
                                                        <th class="text-white">Estado</th>
                                                        <th class="text-white">Opciones</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr class="" v-for="item in lista_usuarios" :key="item.id">

                                                        <td>{{ item.name }}</td>
                                                        <!-- <td>{{ item.email }}</td> -->
                                                        <td>{{ item.rol }}</td>
                                                        <td>
                                                            <span v-if="item.estado==1"
                                                                class="badge text-bg-primary">Activo</span>
                                                            <span v-else class="badge text-bg-dark">Inactivo</span>
                                                        </td>
                                                        <td>
                                                            <div class="btn-group">
                                                                <button type="button"
                                                                    class="btn btn-danger dropdown-toggle btn-sm"
                                                                    data-bs-toggle="dropdown" aria-expanded="false">
                                                                    Acciones
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li @click="desactivar(item)" v-if="item.estado==1">
                                                                        <a class="dropdown-item text-danger" href="#">
                                                                            <i class="fas fa-times"></i> desactivar</a>
                                                                    </li>
                                                                    <li @click="activar(item)" v-else><a
                                                                            class="dropdown-item text-success" href="#">
                                                                            <i class="fas fa-check"></i> activar</a>
                                                                    </li>
                                                                    <li @click="editarUsuario(item)"><a
                                                                            class="dropdown-item text-primary" href="#">
                                                                            <i class="far fa-edit"></i> editar</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                </tbody>
                                            </table>
                                            <br>
                                            <br>
                                </div>
                                <!-- Card Pagination -->
                                <div class="card-footer py-4">
                                            <nav>
                                                <ul class="pagination justify-content-end mb-0">
                                                    <li class="page-item" v-if="pagination.current_page > 1">
                                                        <a class="page-link" href="#"
                                                            @click.prevent="cambiarPagina(pagination.current_page - 1)">Ant</a>
                                                    </li>
                                                    <li class="page-item" v-for="page in pagesNumber" :key="page"
                                                        :class="[page==isActived ? 'active' :'']">
                                                        <a class="page-link" href="#"
                                                            @click.prevent="cambiarPagina(page)"
                                                            :v-text="page">{{ page }}</a>
                                                    </li>
                                                    <li class="page-item"
                                                        v-if="pagination.current_page < pagination.last_page">
                                                        <a class="page-link" href="#"
                                                            @click.prevent="cambiarPagina(pagination.current_page + 1)">Sig</a>
                                                    </li>
                                                </ul>
                                            </nav>
                                </div>
                            </div>
                            <!-- end col -->
                        </div>
                        <!-- end row -->


                </div>
                <!-- </div> -->

                <!-- end page-content-wrapper-->

            </div>
            <!-- Container-fluid -->
        

        <!-- modal nuevo usuario -->
        <div class="modal fade" id="nuevoUsuario" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form class="needs-validation" novalidate>
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 v-if="usuario.accion==0" class="modal-title fs-5" id="exampleModalLabel">Registro nuevo
                                usuario</h1>
                            <h1 v-if="usuario.accion==1" class="modal-title fs-5" id="exampleModalLabel">Modificar
                                usuario</h1>
                            <button @click="cerrarModalNuevo()" type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="form-group mb-2">
                                <label for="nombre">Nombre</label>
                                <input v-model="usuario.nombre" type="text" class="form-control" id="nombre"
                                    autocomplete="off" required>

                            </div>
                            <!-- <div class="form-group mb-2">
                                <label for="nombre">Correo</label>
                                <input v-model="usuario.email" type="email" class="form-control" id="email"
                                    autocomplete="off" required>
                            </div> -->
                            <div class="form-group mb-2">
                                <label for="nombre">Contraseña</label>
                                <input v-model="usuario.password" type="password" class="form-control" id="password"
                                    autocomplete="off" required>
                            </div>

                            <div class="form-group mb-2">
                                <label for="nombre">Rol</label>
                                <select v-model="usuario.id_rol" class="form-control" :required="true">
                                    <option value="0" selected hidden disabled>Seleccione un rol</option>
                                    <option v-for="item in lista_roles" :value="item.id" :key="item.id">
                                        {{ item.nombre }}</option>
                                </select>
                            </div>
                            <div class="form-group mb-2">
                                <label for="nombre">Empleado</label>
                                <select v-model="usuario.id_empleado" class="form-control" :required="true">
                                    <option value="0" selected hidden disabled>Seleccione un empleado</option>
                                    <option v-for="item in lista_empleados" :value="item.id_empleado" :key="item.id_empleado">
                                        {{ item.nombre +' '+ item.apellidos }}</option>
                                </select>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button @click="cerrarModalNuevo()" type="button" class="btn btn-secondary"
                                data-bs-dismiss="modal">Cerrar</button>
                            <button :disabled="guardando_usuario" v-if="usuario.accion==0" @click="guardarUsuario();" type="button"
                                class="btn btn-primary">Guardar</button>
                            <button v-if="usuario.accion==1" @click="modificarUsuario();" type="button" class="btn btn-primary">Modificar</button>
                        </div>
                    </div>
                </form>
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
                guardando_usuario:false,
                lista_usuarios: [],
                lista_roles: [],
                lista_empleados: [],

                usuario: {
                    id_usuario: 0,
                    nombre: '',
                    email: '',
                    password: '',
                    id_rol: 0,
                    id_empleado: 0,
                    accion: 0,
                },
                pagination : {
                    'total' : 0,
                    'current_page' : 0,
                    'per_page' : 0,
                    'last_page' : 0,
                    'from' : 0,
                    'to' : 0,
                },
                offset : 2,
                mensajeError: '',


            }
        },
        computed:{
            isActived: function(){
                return this.pagination.current_page;
            },
            pagesNumber: function(){
                if(!this.pagination.to){
                    return [];
                }                
                var from = this.pagination.current_page - this.offset;
                if(from < 1){
                    from = 1;
                }
                var to = from + (this.offset * 2);
                if(to >= this.pagination.last_page){
                    to = this.pagination.last_page;
                }
                var pagesArray = [];
                while(from <= to){
                    pagesArray.push(from);
                    from++;
                }
                return pagesArray;
            },
        },
        methods: {
            cambiarPagina(page){
                let me=this;
                me.pagination.current_page=page;
                me.getUsuarios(page);
            },
            abrirModalNuevo() {
                $('#nuevoUsuario').modal('show');
                this.lista_roles_agregar = [];
                this.usuario.nombre = '';
                this.usuario.password = '';
                this.usuario.email = '';
                this.usuario.id_rol = 0;
                this.usuario.accion = 0;
                //this.getUsuarios(1);
                this.getRoles();
                this.getEmpleados();
            },
            activar(usuario) {
                axios.get('/activar_usuario?id_usuario=' + usuario.id).then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(() => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Operación exitosa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getUsuarios(1);
                    })
            },
            desactivar(usuario) {
                axios.get('/desactivar_usuario?id_usuario=' + usuario.id).then((response) => {
                        console.log(response);
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
                    .finally(() => {
                        Swal.fire({
                            position: 'top-end',
                            icon: 'success',
                            title: 'Operación exitosa',
                            showConfirmButton: false,
                            timer: 1500
                        });
                        this.getUsuarios(1);
                    })
            },
            getUsuarios(page) {
                axios.get('/get_usuarios?page='+page).then((response) => {
                        this.lista_usuarios = response.data.data;
                        this.pagination={total:response.data.total, 
                            current_page:response.data.current_page,
                            per_page: response.data.per_page,
                            last_page: response.data.last_page,
                            from: response.data.from,
                            to: response.data.to
                        }
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },

            getRoles() {
                axios.get('/get_roles_usuarios').then((response) => {
                        this.lista_roles = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },

            getEmpleados() {
                axios.get('/get_empleados?criterio='+'empleado.nombre').then((response) => {
                        this.lista_empleados = response.data;
                    })
                    .catch((error) => {
                        console.log(error.message);
                    })
            },



            cerrarModalNuevo() {
                $('#nuevoUsuario').modal('hide');
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
            editarUsuario(item) {
                this.usuario.accion = 1;
                this.usuario.id_usuario = item.id;
                this.usuario.nombre = item.name;
                this.usuario.email = item.email;
                this.usuario.estado = item.estado;
                this.usuario.id_rol = item.id_rol;
                this.usuario.password = '';
                $('#nuevoUsuario').modal('show');
                this.getRoles();
                this.getEmpleados();


            },
            guardarUsuario() {
                this.guardando_usuario=true
                let url = "/save_usuario"

                if (this.usuario.nombre == '') {
                    this.mostrarToastError('Debe ingresar un nombre para el usuario');
                    this.guardando_usuario=false
                } else {
                    // if (this.usuario.email == '') {
                    //     this.mostrarToastError('Debe ingresar un correo electronico');
                    // } else {
                        if (this.usuario.password == '') {
                            this.mostrarToastError('Debe ingresar una contraseña para el usuario');
                            this.guardando_usuario=false;

                        } else {
                            if (this.usuario.id_rol == 0) {
                                this.mostrarToastError('Debe seleccionar un rol de usuario');
                                this.guardando_usuario=false
                            } else {
                                axios.post(url, this.usuario).then((response) => {
                                        console.log(response);
                                    })
                                    .catch((error) => {
                                        console.log(error.message)
                                    })
                                    .finally(() => {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Operación exitosa',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $('#nuevoUsuario').modal('hide');
                                        this.getUsuarios(1);
                                        this.guardando_usuario=false;

                                    })
                            }
                        }
                    // }
                }


            },

            modificarUsuario() {
                let url = "/modify_usuario"
                this.usuario.accion = 1;
                if (this.usuario.nombre == '') {
                    this.mostrarToastError('Debe ingresar un nombre para el usuario');
                } else {
                    // if (this.usuario.email == '') {
                    //     this.mostrarToastError('Debe ingresar un correo electronico');
                    // } else {
                        if (this.usuario.password == '') {
                            this.mostrarToastError('Debe ingresar una contraseña para el usuario');
                        } else {
                            if (this.usuario.id_rol == 0) {
                                this.mostrarToastError('Debe seleccionar un rol de usuario');
                            } else {
                                axios.post(url, this.usuario).then((response) => {
                                        console.log(response);
                                    })
                                    .catch((error) => {
                                        console.log(error.message)
                                    })
                                    .finally(() => {
                                        Swal.fire({
                                            position: 'top-end',
                                            icon: 'success',
                                            title: 'Operación exitosa',
                                            showConfirmButton: false,
                                            timer: 1500
                                        });
                                        $('#nuevoUsuario').modal('hide');
                                        this.getUsuarios(1);

                                    })
                            }
                        }
                    // }
                }


            },

            /*guardarRol() {
                let url = "/save_rol"
                this.rol.permisos = this.lista_roles_agregar;
                if (this.rol.nombre == '') {
                    this.mostrarToastError('Falta el nombre del rol');
                } else {
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
                            $('#nuevoUsuario').modal('hide');
                            this.getArrayRoles();

                        })
                }
            },
            modificarRol() {
                let url = "/modify_rol"
                this.rol.permisos = this.lista_roles_agregar;
                if (this.rol.nombre == '') {
                    this.mostrarToastError('Falta el nombre del rol');
                } else {
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
                            $('#nuevoUsuario').modal('hide');
                            this.getArrayRoles();

                        })
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
                        $('#nuevoUsuario').modal('show');
                    })
            },*/





        },
        mounted() {
            console.log('Component mounted.');
            this.getUsuarios(1);
        }


    }

</script>
