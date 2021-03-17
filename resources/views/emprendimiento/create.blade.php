@extends('adminlte::page')
@section('title', 'Crear Emprendimiento')

@section('content')

    
    <h1>Crear Emprendimiento</h1>   

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Crear Emprendimiento</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/emprendimiento') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('emprendimiento.form', ['modo'=>'crear'])


                    </form>
                </div>
            </div>
        </div>
    </div>


@endsection