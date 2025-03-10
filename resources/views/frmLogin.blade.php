<!doctype html>
<html lang="en">

    <head>
        
        <meta charset="utf-8" />
        <title>Login | Nazox - Admin & Dashboard Template</title>
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
        <meta content="Themesdesign" name="author" />
        <!-- App favicon -->
        <link rel="shortcut icon" href="assets/images/favicon.ico">



        <!-- Bootstrap Css -->
        <link href="assets/css/bootstrap.min.css" id="bootstrap-style" rel="stylesheet" type="text/css" />
        <!-- Icons Css -->
        <link href="assets/css/icons.min.css" rel="stylesheet" type="text/css" />
        <!-- App Css-->
        <link href="assets/css/app.min.css" id="app-style" rel="stylesheet" type="text/css" />

    </head>

    <body class="auth-body-bg">
        <div>
            <div class="container-fluid p-0">
                <div class="row g-0">
                    <div class="col-lg-6">
                        <div class="authentication-page-content p-4 d-flex align-items-center min-vh-100">
                            <div class="w-100">
                                <div class="row justify-content-center">
                                    <div class="col-lg-9">
                                        <div>
                                            <div class="text-center">
                                                <div>
                                                    <a href="/" class="">
                                                        <img src="assets/images/logo-dark.png" alt="" height="100" class="auth-logo logo-dark mx-auto">
                                                        <img src="assets/images/logo-light.png" alt="" height="100" class="auth-logo logo-light mx-auto">
                                                    </a>
                                                </div>
    
                                                {{-- <h4 class="font-size-18 mt-4">Welcome Back !</h4>
                                                <p class="text-muted">Sign in to continue to Nazox.</p> --}}
                                            </div>
                                            @if(session('mensaje'))
                                            <div class="alert alert-warning alert-dismissible fade show bg-info text-white mt-3" role="alert">
                                                {{session('mensaje')}}.
                                                {{-- <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Cerrar"></button> --}}
                                            </div>
                                            @endif
                                            <div class="p-2 mt-5">
                                                <form class="" action="/login_process" method="post">
                                                    @csrf
                                                    <div class="mb-3 auth-form-group-custom mb-4">
                                                        <i class="ri-user-2-line auti-custom-input-icon"></i>
                                                        <label for="username" class="fw-semibold">Usuario</label>
                                                        <input type="text" class="form-control" id="username" placeholder="Enter username" name="name">
                                                    </div>
                            
                                                    <div class="mb-3 auth-form-group-custom mb-4">
                                                        <i class="ri-lock-2-line auti-custom-input-icon"></i>
                                                        <label for="userpassword">Contraseña</label>
                                                        <input type="password" class="form-control" id="userpassword" placeholder="Enter password" name="password">
                                                    </div>
                            
                                                    {{-- <div class="form-check">
                                                        <input type="checkbox" class="form-check-input" id="customControlInline">
                                                        <label class="form-check-label" for="customControlInline">Remember me</label>
                                                    </div> --}}

                                                    <div class="mt-4 text-center">
                                                        <button class="btn btn-primary w-md waves-effect waves-light" type="submit">Ingresar</button>
                                                    </div>

                                                    {{-- <div class="mt-4 text-center">
                                                        <a href="auth-recoverpw.html" class="text-muted"><i class="mdi mdi-lock me-1"></i> Forgot your password?</a>
                                                    </div> --}}
                                                </form>
                                            </div>

                                            {{-- <div class="mt-5 text-center">
                                                <p>Don't have an account ? <a href="auth-register.html" class="fw-medium text-primary"> Register </a> </p>
                                                <p>© <script>document.write(new Date().getFullYear())</script> Nazox. Crafted with <i class="mdi mdi-heart text-danger"></i> by Themesdesign</p>
                                            </div> --}}
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="authentication-bg">
                            <div class="bg-overlay"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        

        <!-- JAVASCRIPT -->
        <script src="assets/libs/jquery/jquery.min.js"></script>
        <script src="assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
        <script src="assets/libs/metismenu/metisMenu.min.js"></script>
        <script src="assets/libs/simplebar/simplebar.min.js"></script>
        <script src="assets/libs/node-waves/waves.min.js"></script>

        <script src="assets/js/app.js"></script>

    </body>
</html>
