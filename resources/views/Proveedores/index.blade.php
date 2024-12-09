@extends('adminlte::page')

@section('title', 'Proveedores')

@section('content_header')
    <h1>GESTIÓN DE PROVEEDORES</h1>
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
                    Nuevo Proveedor
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="proveedores" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD PROVEEDOR</th>
                            <th>NOMBRE PROVEEDOR</th>
                            <th>TELEFONO</th>
                            <th>DIRECCION</th>
                            <th>EMAIL</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proveedores as $proveedor)
                        <tr>
                            <td class="text-center">{{ $proveedor['COD_PROVEEDOR'] }}</td>
                            <td>{{ $proveedor['NOMBRE_PROVEEDOR'] }}</td>
                            <td>{{ $proveedor['TELEFONO'] }}</td>
                            <td>{{ $proveedor['DIRECCION'] }}</td>
                            <td>{{ $proveedor['EMAIL'] }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
                                    data-target="#editModal{{ $proveedor['COD_PROVEEDOR'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $proveedor['COD_PROVEEDOR'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $proveedor['COD_PROVEEDOR'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $proveedor['COD_PROVEEDOR'] }}">Editar Proveedor</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('proveedores.update', $proveedor['COD_PROVEEDOR']) }}" method="POST">
                                            @csrf
                                            @method('PUT')
                                            
                                            <!-- NOMBRE_PROVEEDOR --> 
                                            <div class="form-group"> 
                                                <label for="NOMBRE_PROVEEDOR">Nombre del Proveedor</label> 
                                                <input type="text" class="form-control" id="NOMBRE_PROVEEDOR" name="NOMBRE_PROVEEDOR" value="{{ $proveedor['NOMBRE_PROVEEDOR'] }}" required> 
                                            </div> 
                                            <!-- TELEFONO --> 
                                            <div class="form-group"> 
                                                <label for="TELEFONO">Teléfono</label> 
                                                <input type="text" class="form-control" id="TELEFONO" name="TELEFONO" value="{{ $proveedor['TELEFONO'] }}" required> 
                                            </div> 
                                            <!-- DIRECCION --> 
                                            <div class="form-group"> 
                                                <label for="DIRECCION">Dirección</label> 
                                                <input type="text" class="form-control" id="DIRECCION" name="DIRECCION" value="{{ $proveedor['DIRECCION'] }}" required> 
                                            </div> 
                                            <!-- EMAIL --> 
                                            <div class="form-group"> 
                                                <label for="EMAIL">Email</label> 
                                                <input type="email" class="form-control" id="EMAIL" name="EMAIL" value="{{ $proveedor['EMAIL'] }}" required> 
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

<!-- Modal de creación de nuevo proveedor -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nuevo Proveedor</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('proveedores.store') }}" method="POST">
                    @csrf
                    
                    <!-- NOMBRE_PROVEEDOR --> 
                    <div class="form-group"> 
                        <label for="NOMBRE_PROVEEDOR">Nombre del Proveedor</label> 
                        <input type="text" class="form-control" id="NOMBRE_PROVEEDOR" name="NOMBRE_PROVEEDOR" value="{{ old('NOMBRE_PROVEEDOR') }}" required> 
                    </div> 
                    <!-- TELEFONO --> 
                    <div class="form-group"> 
                        <label for="TELEFONO">Teléfono</label> 
                        <input type="text" class="form-control" id="TELEFONO" name="TELEFONO" value="{{ old('TELEFONO') }}" required> 
                    </div> 
                    <!-- DIRECCION --> 
                    <div class="form-group"> 
                        <label for="DIRECCION">Dirección</label> 
                        <input type="text" class="form-control" id="DIRECCION" name="DIRECCION" value="{{ old('DIRECCION') }}" required> 
                    </div> 
                    <!-- EMAIL --> 
                    <div class="form-group"> 
                        <label for="EMAIL">Email</label> 
                        <input type="email" class="form-control" id="EMAIL" name="EMAIL" value="{{ old('EMAIL') }}" required> 
                    </div> 
                  
                    <!-- Botones -->
                    <button type="submit" class="btn btn-primary">Guardar Proveedor</button>
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
        $('#proveedores').DataTable({
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
