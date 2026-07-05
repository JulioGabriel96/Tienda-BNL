@extends('layouts.app')

@section('title', 'Ventas de ' . $producto->nombre)

@section('app_content')
<div class="row pt-3">
    <div class="col-lg-12">
        <div class="row">
            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-info">
                        <i class="fas fa-calendar-day"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total de ventas de hoy</span>
                        <span class="info-box-number">
                            ${{ number_format((float) $totalVentasHoy, 2, ',', '.') }}
                        </span>
                        <span class="text-muted">
                            {{ $cantidadVendidaHoy }} {{ (int) $cantidadVendidaHoy === 1 ? 'unidad vendida' : 'unidades vendidas' }}
                        </span>
                    </div>
                </div>
            </div>

            <div class="col-md-6">
                <div class="info-box">
                    <span class="info-box-icon bg-success">
                        <i class="fas fa-chart-line"></i>
                    </span>
                    <div class="info-box-content">
                        <span class="info-box-text">Total histórico de ventas</span>
                        <span class="info-box-number">
                            ${{ number_format((float) $totalVentasHistorico, 2, ',', '.') }}
                        </span>
                        <span class="text-muted">
                            {{ $cantidadVendidaHistorica }} {{ (int) $cantidadVendidaHistorica === 1 ? 'unidad vendida' : 'unidades vendidas' }}
                        </span>
                    </div>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <h5 class="card-title mb-0">
                    <i class="fas fa-shopping-cart"></i> Ventas de {{ $producto->nombre }}
                </h5>
                <div class="card-tools">
                    <a href="{{ route('productos.index') }}" class="btn btn-secondary btn-sm">
                        <i class="fas fa-arrow-left"></i> Volver
                    </a>
                </div>
            </div>

            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead>
                        <tr>
                            <th>Comprobante</th>
                            <th>Fecha</th>
                            <th>Hora</th>
                            <th class="text-center">Cantidad</th>
                            <th class="text-right">Precio unitario</th>
                            <th class="text-right">Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse ($ventas as $detalle)
                            <tr>
                                <td>{{ $detalle->venta?->nro_comprobante ?? $detalle->venta_id }}</td>
                                <td>{{ $detalle->venta?->fecha?->format('d/m/Y') ?? '-' }}</td>
                                <td>{{ $detalle->venta?->hora ?? '-' }}</td>
                                <td class="text-center">{{ $detalle->cantidad }}</td>
                                <td class="text-right">
                                    ${{ number_format((float) $detalle->precio_unitario, 2, ',', '.') }}
                                </td>
                                <td class="text-right">
                                    ${{ number_format($detalle->cantidad * (float) $detalle->precio_unitario, 2, ',', '.') }}
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center text-muted py-4">
                                    No se registraron ventas para este producto.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if ($ventas->hasPages())
                <div class="card-footer d-flex justify-content-end">
                    {{ $ventas->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
