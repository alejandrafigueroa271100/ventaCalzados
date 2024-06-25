@php
  use App\Http\Controllers\LoginController;   

    $login_controller = new LoginController();
@endphp

<!-- ========== Left Sidebar Start ========== -->
<div class="vertical-menu" style="background-color:rgb(65, 65, 65)">

    <div data-simplebar class="h-100">

        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu list-unstyled" id="side-menu">
              
                @if($login_controller->permisoSistema('usuarios', auth()->user()->id_rol)
                || $login_controller->permisoSistema('roles', auth()->user()->id_rol))
                <li class="border-dark border-bottom border-1">
                    <a href="javascript: void(0);" class="has-arrow waves-effect">
                        <i class="ri-store-2-line"></i>
                        <span>Gestión de usuarios</span>
                    </a>
                    <ul class="sub-menu" aria-expanded="false">
                    @if($login_controller->permisoSistema('usuarios', auth()->user()->id_rol))
                        <li><a href="/usuarios">Usuarios</a></li>
                    @endif
                    @if($login_controller->permisoSistema('roles', auth()->user()->id_rol))
                        <li><a href="/roles">Roles y permisos</a></li>
                    @endif
                       
                    </ul>
                </li>
                @endif

                @if($login_controller->permisoSistema('categorias', auth()->user()->id_rol))
                <li class="border-dark border-bottom border-1">
                    <a href="/categorias" class=" waves-effect">
                        <i class="ri-calendar-2-line"></i>
                        <span>Categorias</span>
                    </a>
                </li>
                @endif

                @if($login_controller->permisoSistema('productos', auth()->user()->id_rol))
                <li class="border-dark border-bottom border-1">
                    <a href="/productos" class=" waves-effect">
                        <i class="ri-chat-1-line"></i>
                        <span>Productos</span>
                    </a>
                </li>
                @endif
                @if($login_controller->permisoSistema('clientes', auth()->user()->id_rol))
                <li class="border-dark border-bottom border-1">
                    <a href="/clientes" class=" waves-effect">
                        <i class="ri-chat-1-line"></i>
                        <span>Clientes</span>
                    </a>
                </li>
                @endif

                @if($login_controller->permisoSistema('empleados', auth()->user()->id_rol))
                <li class="border-dark border-bottom border-1">
                    <a href="/empleados" class=" waves-effect">
                        <i class="ri-chat-1-line"></i>
                        <span>Empleados</span>
                    </a>
                </li>
                @endif
            </ul>
        </div>
        <!-- Sidebar -->
    </div>
</div>
<!-- Left Sidebar End -->