@extends('adminlte::page')

@section('title', 'Compras')

@section('content_header')
    <h1>COMPRA DE PRODUCTOS</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <h3 class="card-title"></h3>
                <div class="card-tools">
                    <div class="input-group input-group-sm" style="width: 150px;">
                        <div class="input-group-append"></div>
                    </div>
                </div>
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#createModal">
                    Nueva Compra
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="compras" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD COMPRA</th>
                            <th>COD_PROVEEDOR</th>
                            <th>FEC_COMPRA</th>
                            <th>TOTAL</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($compras as $compra)
                        <tr>
                            <td class="text-center">{{ $compra['COD_COMPRA'] }}</td>
                            <td>{{ $compra['COD_PROVEEDOR'] }}</td>
                            <td>{{ $compra['FEC_COMPRA'] }}</td>
                            <td>{{ $compra['TOTAL'] }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
                                    data-target="#editModal{{ $compra['COD_COMPRA'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $compra['COD_COMPRA'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $compra['COD_COMPRA'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $compra['COD_COMPRA'] }}">Editar Compra</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('compras.update', $compra['COD_COMPRA']) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <!-- COD_PROVEEDOR --> 
                                            <div class="form-group"> 
                                                <label for="COD_PROVEEDOR">Código del Proveedor</label> 
                                                <input type="number" class="form-control" id="COD_PROVEEDOR" name="COD_PROVEEDOR" value="{{ $compra['COD_PROVEEDOR'] }}" required> 
                                            </div> 
                                            <!-- FEC_COMPRA --> 
                                            <div class="form-group"> 
                                                <label for="FEC_COMPRA">Fecha de Compra</label> 
                                                <input type="date" class="form-control" id="FEC_COMPRA" name="FEC_COMPRA" value="{{ $compra['FEC_COMPRA'] }}" required> 
                                            </div> 
                                            <!-- TOTAL --> 
                                            <div class="form-group"> 
                                                <label for="TOTAL">Total</label> 
                                                <input type="number" step="0.01" class="form-control" id="TOTAL" name="TOTAL" value="{{ $compra['TOTAL'] }}" required> 
                                            </div> 

                                            <!-- Botones -->
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
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>

<!-- Modal de creación de nueva compra -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nueva Compra</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('compras.store') }}" method="POST">
                    @csrf
                    
                    <!-- COD_PROVEEDOR --> 
                    <div class="form-group"> 
                        <label for="COD_PROVEEDOR">Código del Proveedor</label> 
                        <input type="number" class="form-control" id="COD_PROVEEDOR" name="COD_PROVEEDOR" required> 
                    </div> 
                    <!-- FEC_COMPRA --> 
                    <div class="form-group"> 
                        <label for="FEC_COMPRA">Fecha de Compra</label> 
                        <input type="date" class="form-control" id="FEC_COMPRA" name="FEC_COMPRA" required> 
                    </div> 
                    <!-- TOTAL --> 
                    <div class="form-group"> 
                        <label for="TOTAL">Total</label> 
                        <input type="number" step="0.01" class="form-control" id="TOTAL" name="TOTAL" required> 
                    </div> 
                  
                    <!-- Botones -->
                    <button type="submit" class="btn btn-primary">Guardar Compra</button>
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                </form>
            </div>
        </div>
    </div>
</div>
@stop

@section('css')
<!-- DataTables CSS -->
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css">
@stop

@section('js')
<!-- jQuery -->
<script src="https://code.jquery.com/jquery-3.7.0.min.js"></script>
<!-- DataTables JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>
<!-- DataTables Initialization -->
<script type="text/javascript">
    $(document).ready(function () {
        $('#compras').DataTable({
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