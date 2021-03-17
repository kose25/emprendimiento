@extends('adminlte::page')
@section('title', 'Entidad')

@section('content')







@if(Session::has('mensaje'))
{{ Session::get('mensaje') }}
@endif

<div class="card">
    <div class="card-header">
        <h3 class="card-title">Entidades</h3>
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead class="thead-light">
                    <tr>
                        <th>id</th>
                        <th>nombre</th>
                        <th>descripcion</th>
                        <th>email</th>
                        <th>nit</th>
                        <th>foto</th>
                        <th>celular</th>
                        <th>Direccion</th>
                        <th>accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($entidades as $entidad)
                    <tr>
                        <td>{{ $entidad->id }}</td>
                        <td>{{ $entidad->name }}</td>
                        <td>{{ $entidad->descripcion }}</td>
                        <td>{{ $entidad->email }}</td>
                        <td>{{ $entidad->nit }}</td>
                        <td>@if(isset($entidad->foto))
                            <a href="{{ asset('storage').'/'.$entidad->foto}}" target="_blank">ver foto</a>
                            @else
                            No tiene foto
                            @endif
                        </td>
                        <td>{{ $entidad->celular }}</td>
                        <td>{{ $entidad->direccion }}</td>
                        <td><a href="{{ url('/entidad/'.$entidad->id.'/edit') }}">Editar</a> ||
                            <form action="{{ url('/entidad/'.$entidad->id) }}" method="post">
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
        {!! $entidades->links() !!}
    </div>
</div>






@endsection