@extends('adminlte::page')

@section('title', 'Reservaciones')

@section('content_header')
    <h1>HISTORIAL DE RESERVACIÓN</h1>
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
                    Nueva Reservación
                </button>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <table id="reservaciones" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>COD RESERVACIÓN</th>
                            <th>COD_CLIENTE</th>
                            <th>NOMBRE_CLIENTE</th>
                            <th>NÚMERO_TELÉFONO</th>
                            <th>EDAD_CLIENTE</th>
                            <th>EMAIL_CLIENTE</th>
                            <th>FEC_RESERVACIÓN</th>
                            <th>ESTADO</th>
                            <th>NOMBRE_SERVICIO</th>
                            <th>DESCRIPCIÓN_SERVICIO</th>
                            <th>PRECIO</th>
                            <th>DURACIÓN</th>
                            <th>Acciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($reservaciones as $reservacion)
                        <tr>
                            <td class="text-center">{{ $reservacion['COD_RESERVACION'] }}</td>
                            <td>{{ $reservacion['COD_CLIENTE'] }}</td>
                            <td>{{ $reservacion['NOMBRE_CLIENTE'] }}</td>
                            <td>{{ $reservacion['NUMERO_TELEFONO'] }}</td>
                            <td>{{ $reservacion['EDAD_CLIENTE'] }}</td>
                            <td>{{ $reservacion['EMAIL_CLIENTE'] }}</td>
                            <td>{{ $reservacion['FEC_RESERVACION'] }}</td>
                            <td>{{ $reservacion['ESTADO'] }}</td>
                            <td>{{ $reservacion['NOMBRE_SERVICIO'] }}</td>
                            <td>{{ $reservacion['DESCRIPCION_SERVICIO'] }}</td>
                            <td>{{ $reservacion['PRECIO'] }}</td>
                            <td>{{ $reservacion['DURACION'] }}</td>
                            <td>
                                <button type="button" class="btn btn-primary btn-sm" data-toggle="modal" data-target="#editModal{{ $reservacion['COD_RESERVACION'] }}">
                                    Actualizar Datos
                                </button>
                            </td>
                        </tr>

                        <!-- Modal de edición -->
                        <div class="modal fade" id="editModal{{ $reservacion['COD_RESERVACION'] }}" tabindex="-1" role="dialog" aria-labelledby="editModalLabel{{ $reservacion['COD_RESERVACION'] }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="editModalLabel{{ $reservacion['COD_RESERVACION'] }}">Editar Reservación</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                    <div class="modal-body">
                                        <form action="{{ route('reservaciones.update', $reservacion['COD_RESERVACION']) }}" method="POST">
                                            @csrf
                                            @method('PUT')

                                            <div class="form-group">
                                                <label for="COD_CLIENTE">Código del Cliente</label>
                                                <input type="number" class="form-control" id="COD_CLIENTE" name="COD_CLIENTE" value="{{ $reservacion['COD_CLIENTE'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="NOMBRE_CLIENTE">Nombre del Cliente</label>
                                                <input type="text" class="form-control" id="NOMBRE_CLIENTE" name="NOMBRE_CLIENTE" value="{{ $reservacion['NOMBRE_CLIENTE'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="NUMERO_TELEFONO">Número de Teléfono</label>
                                                <input type="number" class="form-control" id="NUMERO_TELEFONO" name="NUMERO_TELEFONO" value="{{ $reservacion['NUMERO_TELEFONO'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="EDAD_CLIENTE">Edad del Cliente</label>
                                                <input type="number" class="form-control" id="EDAD_CLIENTE" name="EDAD_CLIENTE" value="{{ $reservacion['EDAD_CLIENTE'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="EMAIL_CLIENTE">Correo Electrónico</label>
                                                <input type="email" class="form-control" id="EMAIL_CLIENTE" name="EMAIL_CLIENTE" value="{{ $reservacion['EMAIL_CLIENTE'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="FEC_RESERVACION">Fecha de Reservación</label>
                                                <input type="date" class="form-control" id="FEC_RESERVACION" name="FEC_RESERVACION" value="{{ $reservacion['FEC_RESERVACION'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="ESTADO">Estado</label>
                                                <input type="text" class="form-control" id="ESTADO" name="ESTADO" value="{{ $reservacion['ESTADO'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="NOMBRE_SERVICIO">Nombre del Servicio</label>
                                                <input type="text" class="form-control" id="NOMBRE_SERVICIO" name="NOMBRE_SERVICIO" value="{{ $reservacion['NOMBRE_SERVICIO'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="DESCRIPCION_SERVICIO">Descripción del Servicio</label>
                                                <textarea class="form-control" id="DESCRIPCION_SERVICIO" name="DESCRIPCION_SERVICIO" rows="3" required>{{ $reservacion['DESCRIPCION_SERVICIO'] }}</textarea>
                                            </div>
                                            <div class="form-group">
                                                <label for="PRECIO">Precio</label>
                                                <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" value="{{ $reservacion['PRECIO'] }}" required>
                                            </div>
                                            <div class="form-group">
                                                <label for="DURACION">Duración</label>
                                                <input type="number" class="form-control" id="DURACION" name="DURACION" value="{{ $reservacion['DURACION'] }}" required>
                                            </div>
                                            <button type="submit" class="btn btn-primary">Actualizar</button>
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
<!-- Modal de creación de nueva reservación -->
<div class="modal fade" id="createModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="createModalLabel">Nueva Reservación</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('reservaciones.store') }}" method="POST">
                    @csrf
                    <!-- COD_CLIENTE -->
        <div class="form-group">
            <label for="COD_CLIENTE">Código del Cliente</label>
            <input type="number" class="form-control" id="COD_CLIENTE" name="COD_CLIENTE" required>
        </div>
        
        <!-- NOMBRE_CLIENTE -->
        <div class="form-group">
            <label for="NOMBRE_CLIENTE">Nombre del Cliente</label>
            <input type="text" class="form-control" id="NOMBRE_CLIENTE" name="NOMBRE_CLIENTE" required>
        </div>
        
        <!-- NUMERO_TELEFONO -->
        <div class="form-group">
            <label for="NUMERO_TELEFONO">Número de Teléfono</label>
            <input type="number" class="form-control" id="NUMERO_TELEFONO" name="NUMERO_TELEFONO" required>
        </div>
        
        <!-- EDAD_CLIENTE -->
        <div class="form-group">
            <label for="EDAD_CLIENTE">Edad del Cliente</label>
            <input type="number" class="form-control" id="EDAD_CLIENTE" name="EDAD_CLIENTE" required>
        </div>
        
        <!-- EMAIL_CLIENTE -->
        <div class="form-group">
            <label for="EMAIL_CLIENTE">Correo Electrónico</label>
            <input type="email" class="form-control" id="EMAIL_CLIENTE" name="EMAIL_CLIENTE" required>
        </div>
        
        <!-- FEC_RESERVACION -->
        <div class="form-group">
            <label for="FEC_RESERVACION">Fecha de Reservación</label>
            <input type="date" class="form-control" id="FEC_RESERVACION" name="FEC_RESERVACION" required>
        </div>
        
        <!-- ESTADO -->
        <div class="form-group">
            <label for="ESTADO">Estado</label>
            <input type="text" class="form-control" id="ESTADO" name="ESTADO" required>
        </div>
        
        <!-- NOMBRE_SERVICIO -->
        <div class="form-group">
            <label for="NOMBRE_SERVICIO">Nombre del Servicio</label>
            <input type="text" class="form-control" id="NOMBRE_SERVICIO" name="NOMBRE_SERVICIO" required>
        </div>
        
        <!-- DESCRIPCION_SERVICIO -->
        <div class="form-group">
            <label for="DESCRIPCION_SERVICIO">Descripción del Servicio</label>
            <textarea class="form-control" id="DESCRIPCION_SERVICIO" name="DESCRIPCION_SERVICIO" rows="3" required></textarea>
        </div>
        
        <!-- PRECIO -->
        <div class="form-group">
            <label for="PRECIO">Precio</label>
            <input type="number" step="0.01" class="form-control" id="PRECIO" name="PRECIO" required>
        </div>
        
        <!-- DURACION -->
        <div class="form-group">
            <label for="DURACION">Duración</label>
            <input type="number" class="form-control" id="DURACION" name="DURACION" required>
        </div>
        
                    <!-- Añadir más campos según sea necesario -->
                    <button type="submit" class="btn btn-primary">Guardar Reservación</button>
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
        $('#reservaciones').DataTable();
    });
</script>
@stop
