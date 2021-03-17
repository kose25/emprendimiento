@extends('adminlte::page')
@section('title', 'Emprendedor')

@section('content')





<h1>lista de emprendedores</h1>

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Emprendedores</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>cedula</th>
                        <th>foto</th>
                        <th>nombre</th>
                        <th>apellidos</th>
                        <th>celular</th>
                        <th>direccion</th>
                        <th>sexo</th>
                        <th>email</th>
                        <th>Fecha de Nacimiento</th>
                        <th>accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($emprendedores as $emprendedor)
                    <tr>
                        <td>{{ $emprendedor->id }}</td>
                        <td>{{ $emprendedor->cedula }}</td>
                        <td>@if(isset($emprendedor->foto))
                            <a href="{{ asset('storage').'/'.$emprendedor->foto}}" target="_blank">ver foto</a>
                            @else
                            No tiene foto
                            @endif
                        </td>
                        <td>{{ $emprendedor->name }}</td>
                        <td>{{ $emprendedor->apellidos }}</td>
                        <td>{{ $emprendedor->celular }}</td>
                        <td>{{ $emprendedor->direccion }}</td>
                        <td>{{ $emprendedor->sexo }}</td>
                        <td>{{ $emprendedor->email }}</td>
                        <td>{{ $emprendedor->fechanacimiento }}</td>
                        <td><a href="{{ url('/emprendedor/'.$emprendedor->id.'/edit') }}">Editar</a> ||
                            <form action="{{ url('/emprendedor/'.$emprendedor->id) }}" method="post">
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

    </div>
    <div class="card-footer clearfix">
    </div>
</div>




@stop