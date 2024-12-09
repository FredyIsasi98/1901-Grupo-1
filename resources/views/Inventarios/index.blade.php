@extends('adminlte::page')

@section('title', 'Inventarios')

@section('content_header')
    <h1>GESTIÓN DE INVENTARIOS</h1>
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
                    Nuevo Producto
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="inventarios" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD PRODUCTO</th>
                            <th>COD DETALLE</th>
                            <th>NOMBRE PRODUCTO</th>
                            <th>DESCRIPCIÓN</th>
                            <th>PRECIO</th>
                            <th>EXISTENCIAS</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inventarios as $inventario)
                        <tr>
                            <td class="text-center">{{ $inventario['COD_PRODUCTO'] }}</td>
                            <td>{{ $inventario['COD_DETALLE'] }}</td>
                            <td>{{ $inventario['NOMBRE_PRODUCTO'] }}</td>
                            <td>{{ $inventario['DESCRIPCION'] }}</td>
                            <td>{{ $inventario['PRECIO'] }}</td>
                            <td>{{ $inventario['EXISTENCIAS'] }}</td>
                            <td>
                                <!-- Botón para abrir el modal de edición -->
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" 
                                    data-target="#editModal{{ $inventario['COD_PRODUCTO'] }}">
                                    Actualizar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $inventario['COD_PRODUCTO'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $inventario['COD_DETALLE'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $inventario['COD_PRODUCTO'] }}">Editar Producto</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('inventarios.update', $inventario['COD_PRODUCTO']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <!-- COD_DETALLE --> 
                                            <div class="form-group"> 
                                                <label for="COD_DETALLE">Código del Detalle</label> 
                                                <input type="number" class="form-control" id="COD_DETALLE" name="COD_DETALLE" value="{{ $inventario['COD_DETALLE'] }}" required> 
                                            </div> 
                                            
                                            <!-- NOMBRE_PRODUCTO --> 
                                            <div class="form-group"> 
                                                <label for="NOMBRE_PRODUCTO">Nombre del Producto</label> 
                                                <input type="text" class="form-control" id="NOMBRE_PRODUCTO" name="NOMBRE_PRODUCTO" value="{{ $inventario['NOMBRE_PRODUCTO'] }}" required> 
                                            </div> 
                                            <!-- DESCRIPCIÓN --> 
                                            <div class="form-group"> 
                                                <label for="DESCRIPCION">Descripción</label> 
                                                <textarea class="form-control" id="DESCRIPCION" name="DESCRIPCION" value="{{ $inventario['DESCRIPCION'] }}" required></textarea> 
                                            </div> 
                                            <!-- PRECIO --> 
                                            <div class="form-group"> 
                                                <label for="PRECIO">Precio</label> 
                                                <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" value="{{ $inventario['PRECIO'] }}" required> 
                                            </div> 
                                            <!-- EXISTENCIAS --> 
                                            <div class="form-group"> 
                                                <label for="EXISTENCIAS">Existencias</label> 
                                                <input type="number" class="form-control" id="EXISTENCIAS" name="EXISTENCIAS" value="{{ $inventario['EXISTENCIAS'] }}" required> 
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

<!-- Modal de creación de nuevo producto -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nuevo Producto</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('inventarios.store') }}" method="POST">
                    @csrf
                    <!-- COD_DETALLE --> 
                    <div class="form-group"> 
                        <label for="COD_DETALLE">Código del Detalle</label> 
                        <input type="number" class="form-control" id="COD_DETALLE" name="COD_DETALLE" value="{{ $inventario['COD_DETALLE'] }}" required> 
                    </div> 

                    <!-- NOMBRE_PRODUCTO --> 
                    <div class="form-group"> 
                        <label for="NOMBRE_PRODUCTO">Nombre del Producto</label> 
                        <input type="text" class="form-control" id="NOMBRE_PRODUCTO" name="NOMBRE_PRODUCTO" value="{{ $inventario['NOMBRE_PRODUCTO'] }}" required> 
                    </div> 
                    <!-- DESCRIPCIÓN --> 
                    <div class="form-group"> 
                        <label for="DESCRIPCION">Descripción</label> 
                        <textarea class="form-control" id="DESCRIPCION" name="DESCRIPCION" value="{{ $inventario['DESCRIPCION'] }}" required></textarea> 
                    </div> 
                    <!-- PRECIO --> 
                    <div class="form-group"> 
                        <label for="PRECIO">Precio</label> 
                        <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" value="{{ $inventario['PRECIO'] }}" required> 
                    </div> 
                    <!-- EXISTENCIAS --> 
                    <div class="form-group"> 
                        <label for="EXISTENCIAS">Existencias</label> 
                        <input type="number" class="form-control" id="EXISTENCIAS" name="EXISTENCIAS" value="{{ $inventario['EXISTENCIAS'] }}"required> 
                    </div> 
                  
                    <!-- Botones -->
                    <button type="submit" class="btn btn-primary">Guardar Producto</button>
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
        $('#inventarios').DataTable({
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
