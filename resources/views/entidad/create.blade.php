@extends('adminlte::page')
@section('title', 'Crear Entidad')

@section('content')



    <h1>Crear Entidad</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Entidad</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/entidad') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('entidad.form', ['modo'=>'Crear'])


                    </form>
                </div>
            </div>
        </div>
    </div>




@endsection