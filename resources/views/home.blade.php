@extends('layouts.app')

@section('title', 'Inicio')

@section('app_content')
<div class="page-header">
    <div class="d-flex flex-wrap justify-content-between align-items-center">
        <div>
            <h1><i class="fas fa-tachometer-alt"></i> Panel administrativo</h1>
            <p>Base inicial de Tienda BNL con plantilla AdminLTE.</p>
        </div>
        <a href="{{ route('marcas.index') }}" class="btn btn-primary mt-3 mt-sm-0">
            <i class="fas fa-tags"></i> Ir a marcas
        </a>
    </div>
</div>

<div class="row">
    <div class="col-lg-4 col-12">
        <div class="small-box bg-info">
            <div class="inner">
                <h3>BNL</h3>
                <p>Administracion</p>
            </div>
            <div class="icon">
                <i class="fas fa-store"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-success">
            <div class="inner">
                <h3>Laravel</h3>
                <p>Proyecto listo para continuar</p>
            </div>
            <div class="icon">
                <i class="fab fa-laravel"></i>
            </div>
        </div>
    </div>

    <div class="col-lg-4 col-12">
        <div class="small-box bg-warning">
            <div class="inner">
                <h3>PostgreSQL</h3>
                <p>Conexion configurada desde .env</p>
            </div>
            <div class="icon">
                <i class="fas fa-database"></i>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">
            <i class="fas fa-info-circle"></i> Estado inicial
        </h3>
    </div>
    <div class="card-body">
        <p class="mb-0">
            Esta pantalla no consulta tablas. La podes usar como punto de partida mientras avanzas con el desarrollo.
        </p>
    </div>
</div>
@endsection

