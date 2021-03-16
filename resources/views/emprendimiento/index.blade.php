@extends('layouts.app')

@section('content')


<div class="container">




@if(Session::has('mensaje'))
{{ Session::get('mensaje') }}
@endif

@include('layouts.menu')
<h1>lista de empredimientos</h1>

<table class="table table-light">
    <thead class="thead-light">
        <tr>
            <th>id</th>
            <th>nombre</th>
            <th>descripcion</th>
            <th>email</th>
            <th>nit</th>
            <th>ciudad</th>
            <th>foto</th>
            <th>emprendedor</th>
            <th>entidad</th>
            <th>accion</th>
        </tr>
    </thead>
    <tbody>
        @foreach($emprendimientos as $emprendimiento)
        <tr>
            <td>{{ $emprendimiento->id }}</td>
            <td>{{ $emprendimiento->nombre }}</td>
            <td>{{ $emprendimiento->descripcion }}</td>
            <td>{{ $emprendimiento->email }}</td>
            <td>{{ $emprendimiento->nit }}</td>
            <td>{{ $emprendimiento->ciudad }}</td>
            <td><a href="{{ asset('storage').'/'.$emprendimiento->foto}}" target="_blank">ver foto</a></td>
            <td>{{ $emprendimiento->lider }}</td>
            <td>{{ $emprendimiento->entidad }}</td>
            <td><a href="{{ url('/emprendimiento/'.$emprendimiento->id.'/edit') }}">Editar</a> || 
            <form action="{{ url('/emprendimiento/'.$emprendimiento->id) }}" method="post">
            @csrf
            {{ method_field('DELETE') }}
            <input type="submit" value="Borrar" onclick="return confirm('¿Quieres Borrar?')">

            </form>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

{!! $emprendimientos->links() !!}

</div>

@endsection