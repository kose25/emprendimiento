@extends('layouts.app')

@section('content')
<div class="container">
@include('layouts.menu')

    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Editar Emprendedor</div>

                <div class="card-body">
                    <form method="POST" action="{{url('/emprendedor/'.$emprendedor->id)}}" enctype="multipart/form-data">
                        @csrf
                        {{ method_field('PATCH') }}
                        @include('emprendedor.form',['modo'=>'editar'])


                    </form>
                </div>
            </div>
        </div>
    </div>


</div>

</div>

@endsection