<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreModuloRequest;
use App\Http\Requests\UpdateModuloRequest;
use App\Services\Modulo\ModuloService;
use App\Models\Modulo;


class ModuloController extends Controller
{
    //
    public function index(Request $request)
    {
        $tiposModulo = Modulo::tiposModulo();
        $filtros = $request->only(['nombre', 'tipo_modulo', 'estado', 'es_visible']);
        $modulos = Modulo::with('parent')->Buscar($filtros)->orderByRaw('COALESCE(rela_padre, id) ASC')
        ->orderBy('tipo_modulo', 'ASC')->orderBy('orden', 'ASC')->latest()->paginate(5)->withQueryString();
        return view('modulos.index', compact('modulos', 'tiposModulo'));
    }

    public function create(Request $request)
    {
        $iconos = Modulo::getIconos();
        $tiposModulo = Modulo::tiposModulo();
        $modulosPadres = Modulo::where('tipo_modulo', 1)->where('estado', 1)->get();
        return view('modulos.create', compact('iconos', 'tiposModulo', 'modulosPadres'));
    }

    public function store(StoreModuloRequest $request)
    {
        $validatedData=$request->validated();
        $modulo = Modulo::create($validatedData);
        return redirect()->route('modulos.index')->with('success', 'Módulo creado exitosamente.');
    }

    public function show(Modulo $modulo)
    {
        $contenedores = Modulo::where('tipo_modulo', 1)->get();
        $modulosAsociados = Modulo::where('tipo_modulo', 2)->where('rela_padre', $modulo->id)->paginate(3)->withQueryString();
        return view('modulos.show', compact('modulo', 'contenedores', 'modulosAsociados'));
    }

    public function edit(Modulo $modulo)
    {

        $iconos = Modulo::getIconos();
        $tiposModulo = Modulo::tiposModulo();
        $modulosPadres = Modulo::where('tipo_modulo', 1)->where(function ($query) use ($modulo) {
        $query->where('estado', 1)->orWhere('id', $modulo->rela_padre);
        })->get();
        return view('modulos.edit', compact('modulo', 'iconos', 'tiposModulo', 'modulosPadres'));
    }

    public function update(UpdateModuloRequest $request, Modulo $modulo, ModuloService $moduloService)
    {
        $validatedData = $request->validated();
        $moduloService->actualizarModulo($modulo,$validatedData);
        return redirect()->route('modulos.index')->with('success', 'Módulo actualizado exitosamente.');
    }

    public function cambiarEstado(Modulo $modulo, ModuloService $moduloService)
    {
        $modificarEstado = $moduloService->gestionarEstado($modulo);

        if(!$modificarEstado)
        {
            $mensaje = 'El proceso de cambio de estado falló, intentelo de nuevo más tarde';
            $tipoNotificacion = 'error';
        }else{
            $mensaje = 'Se ha modificado correctamente el estado del módulo';
            $tipoNotificacion = 'success';
        }
     
        return redirect()->route('modulos.index')->with($tipoNotificacion, $mensaje);
    }
}
