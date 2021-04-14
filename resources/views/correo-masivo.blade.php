@extends('adminlte::page')
@section('title', 'Correo Masivo')

@section('css')
@livewireStyles
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
<link rel="stylesheet" type="text/css" href="{{asset('css/trix.css')}}">
<script type="text/javascript" src="{{asset('js/trix-core.js')}}"></script>
<style>
    trix-toolbar .trix-button-group--file-tools {
        display: none;
    }
</style>
@endsection

@section('content_header')
<h1>Enviar correo a Usuarios</h1>
@stop
@section('content')

<h1>Correo Masivo</h1>
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <livewire:correo-masivo />
    </div>
</div>

@stop

@section('js')
@livewireScripts
<script>
    document.addEventListener("trix-file-accept", function(event) {
        event.preventDefault();
    })
    Livewire.on('enviando correos', function() {
        Swal.fire({
            title: 'Enviando Correos',
            text: 'No abandone ni cierre la pagina',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        })
    })

    Livewire.on('correos enviados', function() {
        Swal.close()
    })

    Livewire.on('finished', function() {
        Swal.fire(
            'Correos enviados',
            'Se enviaron a todos los usuarios correctamente',
            'success'
        )
    })

    const showLoading = function() {
        Swal.fire({
            title: 'Enviando Correos',
            text: 'No abandone ni cierre la pagina',
            allowEscapeKey: false,
            allowOutsideClick: false,
            onOpen: () => {
                swal.showLoading();
            }
        })
    }

    document.getElementById("fire")
        .addEventListener('click', (event) => {
            showLoading();
        });
</script>



@endsection