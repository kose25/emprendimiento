@extends('adminlte::page')
@section('title', 'Equipo')

@section('css')
@livewireStyles
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('content_header')
<h1>Tus Emprendimientos</h1>
@stop
@section('content')
{{--<h1>Contenido</h1>--}}
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <livewire:emp-management />
    </div>
</div>

@stop

@section('js')
@livewireScripts
<script>
    Livewire.on('emp created', function() {
        Swal.fire(
            'Emprendedor Creado Correctamente',
            'Cuenta de emprendedor creada y agregada a su emprendimiento',
            'success'
        )
        $('#crearEmprendedor').modal('hide');
    })
</script>



@endsection