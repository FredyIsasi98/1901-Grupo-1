@extends('adminlte::page')

@section('title', 'Detalles de Compra')

@section('content_header')
    <h1>DETALLES DE COMPRA</h1>
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
                    Nuevo Detalle
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="detalles" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD DETALLE</th>
                            <th>COD COMPRA</th>
                            <th>CANTIDAD</th>
                            <th>PRECIO</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($detalles as $detalle)
                        <tr>
                            <td class="text-center">{{ $detalle['COD_DETALLE'] }}</td>
                            <td>{{ $detalle['COD_COMPRA'] }}</td>
                            <td>{{ $detalle['CANTIDAD'] }}</td>
                            <td>{{ $detalle['PRECIO'] }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
                                    data-target="#editModal{{ $detalle['COD_DETALLE'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $detalle['COD_DETALLE'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $detalle['COD_DETALLE'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $detalle['COD_DETALLE'] }}">Editar Detalle</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('detalles.update', $detalle['COD_DETALLE']) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <!-- COD_COMPRA --> 
                                            <div class="form-group"> 
                                                <label for="COD_COMPRA">Código de Compra</label> 
                                                <input type="number" class="form-control" id="COD_COMPRA" name="COD_COMPRA" value="{{ old('COD_COMPRA', $detalle['COD_COMPRA']) }}" required> 
                                            </div> 
                                            <!-- CANTIDAD --> 
                                            <div class="form-group"> 
                                                <label for="CANTIDAD">Cantidad</label> 
                                                <input type="number" class="form-control" id="CANTIDAD" name="CANTIDAD" value="{{ old('CANTIDAD', $detalle['CANTIDAD']) }}" required> 
                                            </div> 
                                            <!-- PRECIO --> 
                                            <div class="form-group"> 
                                                <label for="PRECIO">Precio</label> 
                                                <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" value="{{ old('PRECIO', $detalle['PRECIO']) }}" required> 
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

<!-- Modal de creación de nuevo detalle -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nuevo Detalle</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('detalles.store') }}" method="POST">
                    @csrf
                    
                    <!-- COD_COMPRA --> 
                    <div class="form-group"> 
                        <label for="COD_COMPRA">Código de Compra</label> 
                        <input type="number" class="form-control" id="COD_COMPRA" name="COD_COMPRA" required> 
                    </div> 
                    <!-- CANTIDAD --> 
                    <div class="form-group"> 
                        <label for="CANTIDAD">Cantidad</label> 
                        <input type="number" class="form-control" id="CANTIDAD" name="CANTIDAD" required> 
                    </div> 
                    <!-- PRECIO --> 
                    <div class="form-group"> 
                        <label for="PRECIO">Precio</label> 
                        <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" required> 
                    </div> 
                  
                    <!-- Botones -->
                    <button type="submit" class="btn btn-primary">Guardar Detalle</button>
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
<script>
    $(document).ready(function () {
        $('#detalles').DataTable({
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
            }
        });
    });
</script>
@stop
