@extends('adminlte::page')

@section('title', 'Clientes')

@section('content_header')
    <h1>Gestión de Clientes</h1>
@stop

@section('content')
<div class="row">
    <div class="col-12">
        <div class="card">
            <div class="card-header">
                <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#newClientModal">
                    Nuevo Cliente
                </button>
            </div>
            <div class="card-body">
                <table id="clientes" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD_CLIENTE</th>
                            <th>COD_RESERVACION</th>
                            <th>NOMBRE_CLIENTE</th>
                            <th>EDAD_CLIENTE</th>
                            <th>DIREC_CLIENTE</th>
                            <th>TELEFONO_CLIENTE</th>
                            <th>EMAIL_CLIENTE</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($clientes as $cliente)
                        <tr>
                            <td class="text-center">{{ $cliente['COD_CLIENTE'] }}</td>
                            <td>{{ $cliente['COD_RESERVACION'] }}</td>
                            <td>{{ $cliente['NOMBRE_CLIENTE'] }}</td>
                            <td>{{ $cliente['EDAD_CLIENTE'] }}</td>
                            <td>{{ $cliente['DIREC_CLIENTE'] }}</td>
                            <td>{{ $cliente['TELEFONO_CLIENTE'] }}</td>
                            <td>{{ $cliente['EMAIL_CLIENTE'] }}</td>
                            <td>
                                <button 
                                    class="btn btn-primary btn-sm" 
                                    data-toggle="modal" 
                                    data-target="#editClientModal{{ $cliente['COD_CLIENTE'] }}">
                                    Editar
                                </button>
                            </td>
                        </tr>

                        <!-- Modal para editar cliente -->
                        <div class="modal fade" id="editClientModal{{ $cliente['COD_CLIENTE'] }}" tabindex="-1" role="dialog" aria-labelledby="editClientModalLabel{{ $cliente['COD_CLIENTE'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editClientModalLabel{{ $cliente['COD_CLIENTE'] }}">Editar Cliente</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('clientes.update', $cliente['COD_CLIENTE']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="COD_RESERVACION">Código de Reservación</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="COD_RESERVACION" 
                                                    name="COD_RESERVACION" 
                                                    value="{{ $cliente['COD_RESERVACION'] }}" 
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="NOMBRE_CLIENTE">Nombre del Cliente</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="NOMBRE_CLIENTE" 
                                                    name="NOMBRE_CLIENTE" 
                                                    value="{{ $cliente['NOMBRE_CLIENTE'] }}" 
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="EDAD_CLIENTE">Edad</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="EDAD_CLIENTE" 
                                                    name="EDAD_CLIENTE" 
                                                    value="{{ $cliente['EDAD_CLIENTE'] }}" 
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="DIREC_CLIENTE">Dirección</label>
                                                <input 
                                                    type="text" 
                                                    class="form-control" 
                                                    id="DIREC_CLIENTE" 
                                                    name="DIREC_CLIENTE" 
                                                    value="{{ $cliente['DIREC_CLIENTE'] }}" 
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="TELEFONO_CLIENTE">Teléfono</label>
                                                <input 
                                                    type="number" 
                                                    class="form-control" 
                                                    id="TELEFONO_CLIENTE" 
                                                    name="TELEFONO_CLIENTE" 
                                                    value="{{ $cliente['TELEFONO_CLIENTE'] }}" 
                                                    required>
                                            </div>
                                            <div class="form-group">
                                                <label for="EMAIL_CLIENTE">Correo Electrónico</label>
                                                <input 
                                                    type="email" 
                                                    class="form-control" 
                                                    id="EMAIL_CLIENTE" 
                                                    name="EMAIL_CLIENTE" 
                                                    value="{{ $cliente['EMAIL_CLIENTE'] }}" 
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

<!-- Modal para nuevo cliente -->
<div class="modal fade" id="newClientModal" tabindex="-1" role="dialog" aria-labelledby="newClientModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="newClientModalLabel">Nuevo Cliente</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('clientes.store') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="COD_RESERVACION">Código de Reservación</label>
                        <input type="number" class="form-control" id="COD_RESERVACION" name="COD_RESERVACION" required>
                    </div>
                    <div class="form-group">
                        <label for="NOMBRE_CLIENTE">Nombre del Cliente</label>
                        <input type="text" class="form-control" id="NOMBRE_CLIENTE" name="NOMBRE_CLIENTE" required>
                    </div>
                    <div class="form-group">
                        <label for="EDAD_CLIENTE">Edad</label>
                        <input type="number" class="form-control" id="EDAD_CLIENTE" name="EDAD_CLIENTE" required>
                    </div>
                    <div class="form-group">
                        <label for="DIREC_CLIENTE">Dirección</label>
                        <input type="text" class="form-control" id="DIREC_CLIENTE" name="DIREC_CLIENTE" required>
                    </div>
                    <div class="form-group">
                        <label for="TELEFONO_CLIENTE">Teléfono</label>
                        <input type="number" class="form-control" id="TELEFONO_CLIENTE" name="TELEFONO_CLIENTE" required>
                    </div>
                    <div class="form-group">
                        <label for="EMAIL_CLIENTE">Correo Electrónico</label>
                        <input type="email" class="form-control" id="EMAIL_CLIENTE" name="EMAIL_CLIENTE" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar Cliente</button>
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
        $('#clientes').DataTable({
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
