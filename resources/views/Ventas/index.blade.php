@extends('adminlte::page')

@section('title', 'Ventas')

@section('content_header')
    <h1>VENTA DE PRODUCTOS</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSaleModal">
                    Nueva Venta
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="ventas" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD VENTA</th>
                            <th>COD_CLIENTE</th>
                            <th>FEC_VENTA</th>
                            <th>TOTAL</th>
                            <th>METODO_PAGO</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($ventas as $venta)
                        <tr>
                            <td class="text-center">{{ $venta['COD_VENTA'] }}</td>
                            <td>{{ $venta['COD_CLIENTE'] }}</td>
                            <td>{{ $venta['FEC_VENTA'] }}</td>
                            <td>{{ $venta['TOTAL'] }}</td>
                            <td>{{ $venta['METODO_PAGO'] }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#editModal{{ $venta['COD_VENTA'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal para editar venta -->
                        <div class="modal fade" id="editModal{{ $venta['COD_VENTA'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $venta['COD_VENTA'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $venta['COD_VENTA'] }}">Editar Venta</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('ventas.update', $venta['COD_VENTA']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <!-- COD_CLIENTE -->
                                            <div class="form-group">
                                                <label for="COD_CLIENTE">Código del Cliente</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="COD_CLIENTE" 
                                                    name="COD_CLIENTE" 
                                                    value="{{ $venta['COD_CLIENTE'] }}" 
                                                    required>
                                            </div>
                                            <!-- FEC_VENTA -->
                                            <div class="form-group">
                                                <label for="FEC_VENTA">Fecha de Venta</label>
                                                <input 
                                                    type="date" 
                                                    class="form-control" 
                                                    id="FEC_VENTA" 
                                                    name="FEC_VENTA" 
                                                    value="{{ \Carbon\Carbon::parse($venta['FEC_VENTA'])->format('Y-m-d') }}" 
                                                    required>
                                            </div>
                                            <!-- TOTAL -->
                                            <div class="form-group">
                                                <label for="TOTAL">Total</label>
                                                <input 
                                                    type="number" 
                                                    step="0.01" 
                                                    class="form-control" 
                                                    id="TOTAL" 
                                                    name="TOTAL" 
                                                    value="{{ $venta['TOTAL'] }}" 
                                                    required>
                                            </div>
                                            <!-- METODO_PAGO -->
                                            <div class="form-group">
                                                <label for="METODO_PAGO">Método de Pago</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="METODO_PAGO" 
                                                    name="METODO_PAGO" 
                                                    value="{{ $venta['METODO_PAGO'] }}" 
                                                    required>
                                            </div>
                                            
                                            <!-- Botones -->
                                            <button type="submit" class="btn btn-success">Actualizar</button>
                                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.modal -->
                        @endforeach
                    </tbody>
                </table>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Modal para nueva venta -->
<div class="modal fade" id="newSaleModal" tabindex="-1" role="dialog" aria-labelledby="newSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSaleModalLabel">Nueva Venta</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('ventas.store') }}" method="POST">
                    @csrf
                    <!-- Código reutilizado del formulario de creación -->
                    <div class="form-group">
                        <label for="COD_CLIENTE">Código del Cliente</label>
                        <input type="number" class="form-control" id="COD_CLIENTE" name="COD_CLIENTE" required>
                    </div>
                    <div class="form-group">
                        <label for="FEC_VENTA">Fecha de Venta</label>
                        <input type="date" class="form-control" id="FEC_VENTA" name="FEC_VENTA" required>
                    </div>
                    <div class="form-group">
                        <label for="TOTAL">Total</label>
                        <input type="number" step="0.01" class="form-control" id="TOTAL" name="TOTAL" required>
                    </div>
                    <div class="form-group">
                        <label for="METODO_PAGO">Método de Pago</label>
                        <input type="text" class="form-control" id="METODO_PAGO" name="METODO_PAGO" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar Venta</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
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
        $('#ventas').DataTable({
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
