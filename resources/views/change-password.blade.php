@extends('adminlte::page')
@section('title', 'Cambiar Contraseña')

@section('css')
@livewireStyles
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@endsection

@section('content_header')
<h1>Cambia tu Contraseña</h1>
@stop
@section('content')

<h1>Cambiar Contraseña</h1>
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <livewire:change-password />
    </div>
</div>

@stop

@section('js')
@livewireScripts
<script>
    Livewire.on('pass updated', function() {
        Swal.fire(
            'Contraseña Actualizada',
            'Su contraseña se actualizo correntamente',
            'success'
        )
    })
    Livewire.on('error', function() {
        Swal.fire(
            'La contraseña actual no es correcta',
            'Su contraseña no se ha actualizado',
            'error'
        )
    })
</script>



@endsection