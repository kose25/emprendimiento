@extends('adminlte::page')
@section('title', 'Sectores')

@section('css')
@livewireStyles
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('content_header')
<h1>Sectores</h1>
@stop
@section('content')
<h1>Listado de Sectores</h1>
<div class="row justify-content-md-center">
    <div class="col-md-10">
        <livewire:sectores />
    </div>
</div>

@stop

@section('js')
@livewireScripts
<script>
    Livewire.on('sector creado', function() {
        Swal.fire(
            'Sector Creado Correctamente',
            'Se ha creado con exito',
            'success'
        )
        $('#crearSector').modal('hide');
    })
    Livewire.on('sector borrado', function() {
        Swal.fire(
            'Sector borrado Correctamente',
            'Se ha eliminado con exito',
            'success'
        )
    })
    Livewire.on('sector editado', function() {
        Swal.fire(
            'Sector editado Correctamente',
            'Se ha editado con exito',
            'success'
        )
        $('#editarSector').modal('hide');
    })
</script>



@endsection