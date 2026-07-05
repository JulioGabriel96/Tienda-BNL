@extends('adminlte::page')

@section('title', trim($__env->yieldContent('title', 'Inicio')) . ' - Tienda BNL')

@section('content_header')
    @hasSection('content_header')
        @yield('content_header')
    @endif
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger app-alert">
            <h5><i class="icon fas fa-exclamation-triangle"></i> Errores de validacion</h5>
            <ul class="mb-0 mt-2">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    @if (session('success'))
        <div class="alert alert-success alert-dismissible fade show app-alert" role="alert">
            <i class="icon fas fa-check"></i> {{ session('success') }}
            <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
    @endif

    @if (session('error'))
    <div class="alert alert-danger alert-dismissible fade show app-alert" role="alert">
        <i class="icon fas fa-exclamation-triangle"></i> {{ session('error') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Cerrar">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
@endif

    @yield('app_content')
@stop

@section('footer')
    <strong>&copy; 2026 Tienda BNL.</strong> Todos los derechos reservados.
@stop

@section('css')
    <style>
        .page-header {
            background: #ffffff;
            border-radius: 0.25rem;
            border-top: 3px solid #007bff;
            box-shadow: 0 0 1px rgba(0, 0, 0, 0.125), 0 1px 3px rgba(0, 0, 0, 0.2);
            margin-bottom: 1rem;
            padding: 1.25rem;
        }

        .page-header h1 {
            color: #343a40;
            font-size: 1.6rem;
            font-weight: 500;
            margin-bottom: 0.25rem;
        }

        .page-header p {
            color: #6c757d;
            margin-bottom: 0;
        }

        .gap-2 {
            gap: 0.5rem;
        }

        .app-alert {
            margin-top: 1rem;
        }
    </style>
    @stack('styles')
@stop

@section('js')
    @stack('scripts')
@stop
