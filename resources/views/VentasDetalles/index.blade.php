@extends('adminlte::page')

@section('title', 'Ventas Detalles')

@section('content_header')
    <h1>VENTA DE PRODUCTOS DETALLES</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSaleModal">
                    Nuevo Detalle de Venta
                </button>
            </div>
            <div class="card-body">
                <table id="ventasdetalles" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD_DETALLE</th>
                            <th>COD_VENTA</th>
                            <th>COD_PRODUCTO</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventasdetalles as $ventasdetalle)
                        <tr>
                            <td class="text-center">{{ $ventasdetalle->COD_DETALLE ?? $ventasdetalle['COD_DETALLE'] }}</td>
                            <td>{{ $ventasdetalle->COD_VENTA ?? $ventasdetalle['COD_VENTA'] }}</td>
                            <td>{{ $ventasdetalle->COD_PRODUCTO ?? $ventasdetalle['COD_PRODUCTO'] }}</td>
                            <td>{{ $ventasdetalle->CANTIDAD ?? $ventasdetalle['CANTIDAD'] }}</td>
                            <td>{{ $ventasdetalle->PRECIO ?? $ventasdetalle['PRECIO'] }}</td>
                            <td>
                                <button 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#editModal{{ $ventasdetalle->COD_DETALLE ?? $ventasdetalle['COD_DETALLE'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal para editar detalle de venta -->
                        <div class="modal fade" id="editModal{{ $ventasdetalle->COD_DETALLE ?? $ventasdetalle['COD_DETALLE'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $ventasdetalle->COD_DETALLE ?? $ventasdetalle['COD_DETALLE'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $ventasdetalle->COD_DETALLE ?? $ventasdetalle['COD_DETALLE'] }}">Editar Detalle de Venta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ventasdetalles.update', $ventasdetalle->COD_DETALLE ?? $ventasdetalle['COD_DETALLE']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="COD_VENTA">Código de Venta</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="COD_VENTA" 
                                                    name="COD_VENTA" 
                                                    value="{{ $ventasdetalle->COD_VENTA ?? $ventasdetalle['COD_VENTA'] }}" 
                                                    required>
                                            </div>
                                            
                                            <div class="form-group">
                                                <label for="COD_PRODUCTO">Código del Producto</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="COD_PRODUCTO" 
                                                    name="COD_PRODUCTO" 
                                                    value="{{ $ventasdetalle->COD_PRODUCTO ?? $ventasdetalle['COD_PRODUCTO'] }}" 
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="CANTIDAD">Cantidad</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="CANTIDAD" 
                                                    name="CANTIDAD" 
                                                    value="{{ $ventasdetalle->CANTIDAD ?? $ventasdetalle['CANTIDAD'] }}" 
                                                    required>
                                            </div>

                                            <div class="form-group">
                                                <label for="PRECIO">Precio</label>
                                                <input 
                                                    type="number" 
                                                    step="0.01" 
                                                    class="form-control" 
                                                    id="PRECIO" 
                                                    name="PRECIO" 
                                                    value="{{ $ventasdetalle->PRECIO ?? $ventasdetalle['PRECIO'] }}" 
                                                    required>
                                            </div>

                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Modal para nuevo detalle de venta -->
<div class="modal fade" id="newSaleModal" tabindex="-1" role="dialog" aria-labelledby="newSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSaleModalLabel">Nuevo Detalle de Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ventasdetalles.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="COD_VENTA">Código de Venta</label>
                        <input type="number" class="form-control" name="COD_VENTA" required>
                    </div>
                    <div class="form-group">
                        <label for="COD_PRODUCTO">Código de Producto</label>
                        <input type="number" class="form-control" name="COD_PRODUCTO" required>
                    </div>
                    <div class="form-group">
                        <label for="CANTIDAD">Cantidad</label>
                        <input type="number" class="form-control" name="CANTIDAD" required>
                    </div>
                    <div class="form-group">
                        <label for="PRECIO">Precio</label>
                        <input type="number" step="0.01" class="form-control" name="PRECIO" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<script type="text/javascript">
    $(document).ready(function () {
        $('#ventasdetalles').DataTable({
            "language": {
                "lengthMenu": "Mostrar _MENU_ entradas por página",
                "zeroRecords": "No se encontraron resultados",
                "info": "Mostrando _START_ a _END_ de _TOTAL_ entradas",
                "infoEmpty": "No hay datos disponibles",
                "infoFiltered": "(filtrado de _MAX_ entradas totales)",
                "search": "Buscar:",
                "paginate": {
                    "first": "Primero",
                    "last": "Último",
                    "next": "Siguiente",
                    "previous": "Anterior"
                }
            },
            "paging": true,
            "lengthChange": true,
            "searching": true,
            "ordering": true,
            "info": true,
            "autoWidth": false,
            "responsive": true
        });
    });
</script>
@stop
