@extends('adminlte::page')

@section('title', 'Reportes De Compras')

@section('content_header')
    <h1>REPORTE DE COMPRA</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newSaleModal">
                    Nuevo Reporte
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="reportescompras" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD_REPORTE_COM</th>
                            <th>COD_COMPRA</th>
                            <th>FEC_COMPRA</th>
                            <th>TOTAL</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reportescompras as $reportecompra)
                        <tr>
                            <!-- Manejo dinámico: Objeto o arreglo -->
                            <td class="text-center">{{ $reportecompra->COD_REPORTE_COM ?? $reportecompra['COD_REPORTE_COM'] }}</td>
                            <td>{{ $reportecompra->COD_COMPRA ?? $reportecompra['COD_COMPRA'] }}</td>
                            <td>{{ $reportecompra->FEC_COMPRA ?? $reportecompra['FEC_COMPRA'] }}</td>
                            <td>{{ $reportecompra->TOTAL ?? $reportecompra['TOTAL'] }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#editModal{{ $reportecompra->COD_REPORTE_COM ?? $reportecompra['COD_REPORTE_COM'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal para editar reporte compra -->
                        <div class="modal fade" id="editModal{{ $reportecompra->COD_REPORTE_COM ?? $reportecompra['COD_REPORTE_COM'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $reportecompra->COD_REPORTE_COM ?? $reportecompra['COD_REPORTE_COM'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $reportecompra->COD_REPORTE_COM ?? $reportecompra['COD_REPORTE_COM'] }}">Editar Reporte</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('reportescompras.update', $reportecompra->COD_REPORTE_COM ?? $reportecompra['COD_REPORTE_COM']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <!-- COD_COMPRA -->
                                            <div class="form-group">
                                                <label for="COD_COMPRA">Código de la compra</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="COD_COMPRA" 
                                                    name="COD_COMPRA" 
                                                    value="{{ $reportecompra->COD_COMPRA ?? $reportecompra['COD_COMPRA'] }}" 
                                                    required>
                                            </div>
                                            <!-- FEC_COMPRA -->
                                            <div class="form-group">
                                                <label for="FEC_COMPRA">Fecha de compra</label>
                                                <input 
                                                    type="date" 
                                                    class="form-control" 
                                                    id="FEC_COMPRA" 
                                                    name="FEC_COMPRA" 
                                                    value="{{ $reportecompra->FEC_COMPRA ?? $reportecompra['FEC_COMPRA'] }}" 
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
                                                    value="{{ $reportecompra->TOTAL ?? $reportecompra['TOTAL'] }}" 
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

<!-- Modal para nuevo reporte-->
<div class="modal fade" id="newSaleModal" tabindex="-1" role="dialog" aria-labelledby="newSaleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newSaleModalLabel">Nueva Reporte</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reportescompras.store') }}" method="POST">
                    @csrf
                    <!-- Código reutilizado del formulario de creación -->
                    <div class="form-group">
                        <label for="COD_COMPRA">Código del reporte</label>
                        <input type="number" class="form-control" id="COD_COMPRA" name="COD_COMPRA" required>
                    </div>
                    <div class="form-group">
                        <label for="FEC_COMPRA">Fecha de Compra</label>
                        <input type="date" class="form-control" id="FEC_COMPRA" name="FEC_COMPRA" required>
                    </div>
                    <div class="form-group">
                        <label for="TOTAL">Total</label>
                        <input type="number" step="0.01" class="form-control" id="TOTAL" name="TOTAL" required>
                    </div>
                    
                    <button type="submit" class="btn btn-primary">Guardar Reporte</button>
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
        $('#reportescompras').DataTable({
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