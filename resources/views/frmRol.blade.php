@extends('index')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="page-title-box d-sm-flex align-items-center justify-content-between">
            <h4 class="mb-sm-0">Gestion roles y permisos</h4>

            {{-- <div class="page-title-right">
                <ol class="breadcrumb m-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Nazox</a></li>
                    <li class="breadcrumb-item active">Dashboard</li>
                </ol>
            </div> --}}

        </div>
    </div>
</div>
<div id="app" class="row">
        <rol-component></rol-component>
</div>

@endsection