@extends('layouts.app')

@section('content')

<div class="container">

    @include('layouts.menu')
    <h1>Editar Emprendimiento</h1>


    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Emprendimiento</div>

                <div class="card-body">
                    <form action="{{url('/emprendimiento/'.$emprendimiento->id)}}" method="post" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('emprendimiento.form',['modo'=>'editar'])
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

</div>

@endsection

