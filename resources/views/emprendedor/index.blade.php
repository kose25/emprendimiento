@extends('layouts.app')

@section('content')

<div class="container">

    @include('layouts.menu')

    <h1>lista de emprendedores</h1>

    <table class="table table-light">
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

@endsection