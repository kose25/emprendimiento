@extends('layouts.app')

@section('content')

<div class="container">
@include('layouts.menu')

    <h1>Crear Emprendedor</h1>

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header text-center">Crear Emprendedor</div>

                <div class="card-body">
                    <form method="POST" action="{{ url('/emprendedor') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @include('emprendedor.form', ['modo'=>'Crear'])


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>


@endsection