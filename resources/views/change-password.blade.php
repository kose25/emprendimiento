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

    function myFunction() {
        var x = document.getElementById("exampleInputEmail1");
        var y = document.getElementById("exampleInputPassword1");
        var z = document.getElementById("exampleInputPassword2");
        if (x.type === "password" && y.type === "password" && z.type === "password") {
            x.type = "text";
            y.type = "text";
            z.type = "text";
        } else {
            x.type = "password";
            y.type = "password";
            z.type = "password";
        }
    }
</script>



@endsection