@extends('layouts.app')

@section('content')
<div class="container">
    @include('layouts.menu')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Funcionario</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/funcionario/'.$funcionario->id)}}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('funcionario.form',['modo'=>'Editar'])


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

</div>

@endsection