@extends('adminlte::page')
@section('title', 'Actividades Economicas')

@section('css')
@livewireStyles
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('content_header')
<h1>Actividades Economicas</h1>
@stop
@section('content')
<h1>Listado de Actividades Economicas</h1>
<div class="row justify-content-md-center">
    <div class="col-md-10">
        <livewire:actividades />
    </div>
</div>

@stop

@section('js')
@livewireScripts
<script>
    Livewire.on('actividad creada', function() {
        Swal.fire(
            'Sector Creado Correctamente',
            'Se ha creado con exito',
            'success'
        )
        $('#crearActividad').modal('hide');
    })
    Livewire.on('actividad borrada', function() {
        Swal.fire(
            'Sector borrado Correctamente',
            'Se ha eliminado con exito',
            'success'
        )
    })
    Livewire.on('actividad editada', function() {
        Swal.fire(
            'Sector editado Correctamente',
            'Se ha editado con exito',
            'success'
        )
        $('#editarActividad').modal('hide');
    })
</script>



@endsection