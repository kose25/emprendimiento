@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.menu')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Entidad</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/entidad/'.$entidad->id)}}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('entidad.form',['modo'=>'Editar'])


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

</div>

@endsection