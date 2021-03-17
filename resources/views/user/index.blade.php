@extends('adminlte::page')
@section('title', 'Emprendedor')

@section('css')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.5.2/css/bootstrap.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.10.24/css/dataTables.bootstrap4.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/responsive/2.2.7/css/responsive.bootstrap4.min.css">

@endsection

@section('content')





<h1>lista de Usuarios</h1>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Usuarios</h3>
    </div>
    <div class="card-body">

        <div class="d-flex flex-row-reverse">
        <div class="dropleft mb-4">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-user-plus"></i>
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <a class="dropdown-item" href="{{ url('/emprendedor/create') }}">Crear Emprendedor</a>
                <a class="dropdown-item" href="{{ url('/entidad/create') }}">Crear Entidad</a>
                <a class="dropdown-item" href="{{ url('/funcionario/create') }}">Crear Funcionario</a>
            </div>
        </div>
        </div>

        

        <table class="table table-striped table-bordered dt-responsive nowrap" id="example">
            <thead class="thead-light">
                <tr>
                    <th>id</th>
                    <th>Nombre</th>
                    <th>Correo</th>
                    <th>Rol</th>
                    <th>accion</th>
                </tr>
            </thead>
            <tbody>
                @foreach($users as $user)
                <tr>
                    <td>{{ $user->id }}</td>
                    <td>{{ $user->name }}</td>
                    <td>{{ $user->email }}</td>
                    <td>{{ $user->rol }}</td>
                    <!-- <td>@if(isset($user->foto))
                            <a href="{{ asset('storage').'/'.$user->foto}}" target="_blank">ver foto</a>
                            @else
                            No tiene foto
                            @endif
                        </td> -->
                    <td><a href="{{ url('/usuario/'.$user->id.'/edit') }}">Editar</a> ||
                        <form action="{{ url('/emprendedor/'.$user->id) }}" method="post">
                            @csrf
                            {{ method_field('DELETE') }}
                            <input type="submit" value="Borrar" onclick="return confirm('¿Quieres Borrar?')">

                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>


    </div>
    <div class="card-footer clearfix">
    </div>
</div>

@stop

@section('js')

<script src="https://cdn.datatables.net/1.10.24/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.10.24/js/dataTables.bootstrap4.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/dataTables.responsive.min.js"></script>
<script src="https://cdn.datatables.net/responsive/2.2.7/js/responsive.bootstrap4.min.js"></script>
<script>
    $('#example').DataTable({
        responsive: true,
        autoWidth: false
    });
</script>

@endsection