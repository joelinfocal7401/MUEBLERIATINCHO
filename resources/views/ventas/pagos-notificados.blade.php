
@extends('layouts.admin')

@section('content')
<div class="container-fluid px-4 py-4">

    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h2 class="fw-bold mb-1">Pagos notificados</h2>
            <p class="text-muted mb-0">
                Revisa los pagos QR comunicados por los clientes.
            </p>
        </div>

        <a href="{{ route('solicitudes-web.index') }}"
           class="btn btn-outline-secondary">
            Volver a solicitudes
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    @if($solicitudes->isEmpty())
        <div class="card border-0 shadow-sm">
            <div class="card-body text-center py-5">
                <h5>No hay pagos notificados</h5>
                <p class="text-muted mb-0">
                    Cuando un cliente notifique un pago,
                    aparecerá aquí para su revisión.
                </p>
            </div>
        </div>
    @else
        <div class="card border-0 shadow-sm">
            <div class="table-responsive">
                <table class="table table-hover align-middle mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Código</th>
                            <th>Cliente</th>
                            <th>Muebles</th>
                            <th>Total</th>
                            <th>Pago notificado</th>
                            <th>Saldo restante</th>
                            <th class="text-end">Acción</th>
                        </tr>
                    </thead>

                    <tbody>
                    @foreach($solicitudes as $solicitud)
                        @php
                            $cliente = $solicitud->cliente;
                            $montoPagado = (float) (
                                $solicitud->monto_a_pagar ?? 0
                            );

                            $total = (float) (
                                $solicitud->total ?? 0
                            );

                            $saldo = max(0, $total - $montoPagado);
                            $muebles = $solicitud->muebles ?? [];

                            if (is_object($muebles)) {
                                $muebles = (array) $muebles;
                            }
                        @endphp

                        <tr>
                            <td>
                                <strong>
                                    {{ $solicitud->codigo ?? $solicitud->solicitud_id }}
                                </strong>
                            </td>

                            <td>
                                {{ $cliente->nombre ?? $cliente->name ?? $cliente->email ?? 'Cliente no encontrado' }}
                            </td>

                            <td>
                                @forelse($muebles as $mueble)
                                    @php
                                        $mueble = (array) $mueble;
                                    @endphp

                                    <div>
                                        {{ $mueble['nombre'] ?? 'Mueble' }}
                                        <span class="text-muted">
                                            × {{ $mueble['cantidad'] ?? 0 }}
                                        </span>
                                    </div>
                                @empty
                                    <span class="text-muted">
                                        Sin detalle
                                    </span>
                                @endforelse
                            </td>

                            <td>
                                Bs {{ number_format($total, 2) }}
                            </td>

                            <td>
                                <strong>
                                    Bs {{ number_format($montoPagado, 2) }}
                                </strong>

                                <div class="small text-muted">
                                    {{ $solicitud->tipo_pago ?? 'Pago' }}
                                </div>
                            </td>

                            <td>
                                Bs {{ number_format($saldo, 2) }}
                            </td>

                            <td class="text-end">
                                <form
                                    action="{{ route('solicitudes-web.confirmar-pago', $solicitud->solicitud_id) }}"
                                    method="POST"
                                    onsubmit="return confirm('¿Verificaste el pago QR y deseas confirmar esta compra?');"
                                >
                                    @csrf

                                    <button type="submit"
                                            class="btn btn-success btn-sm">
                                        Confirmar pago verificado
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
</div>
@endsection
