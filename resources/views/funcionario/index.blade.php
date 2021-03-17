@extends('adminlte::page')
@section('title', 'Funcionario')

@section('content')







@if(Session::has('mensaje'))
{{ Session::get('mensaje') }}
@endif

<h1>lista de Funcionarios</h1>
<div class="card">
    <div class="card-header">
        <h3 class="card-title"></h3>
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
                        <th>Entidad</th>
                        <th>Direccion</th>
                        <th>accion</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($funcionarios as $funcionario)
                    <tr>
                        <td>{{ $funcionario->id_funcionario }}</td>
                        <td>{{ $funcionario->name }}</td>
                        <td>{{ $funcionario->descripcion }}</td>
                        <td>{{ $funcionario->email }}</td>
                        <td>{{ $funcionario->nit }}</td>
                        <td>@if(isset($funcionario->foto))
                            <a href="{{ asset('storage').'/'.$funcionario->foto}}" target="_blank">ver foto</a>
                            @else
                            No tiene foto
                            @endif
                        </td>
                        <td>{{ $funcionario->celular }}</td>
                        <td>{{ $funcionario->entidad }}</td>
                        <td>{{ $funcionario->direccion }}</td>
                        <td><a href="{{ url('/funcionario/'.$funcionario->id_funcionario.'/edit') }}">Editar</a> ||
                            <form action="{{ url('/funcionario/'.$funcionario->id_funcionario) }}" method="post">
                                @csrf
                                <input type="hidden" name="entidad" value="{{ $funcionario->id }}">
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
    {!! $funcionarios->links() !!}
    </div>
</div>







@endsection