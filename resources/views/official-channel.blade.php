@extends('adminlte::page')
@section('title', 'Inicio')

@section('css')
@livewireStyles
<link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.css" rel="stylesheet">
@endsection

@section('content_header')
<h1>Comunicados Oficiales</h1>
@stop
@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        @if(Auth::user()->rol=='administrador'|| Auth::user()->rol=='entidad')
        <livewire:official-poster />
        @endif

        <!-- Box Comment -->
        <livewire:official-feed />

    </div>

</div>

@stop

@section('js')
<!-- Summernote -->
<script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-bs4.min.js"></script>
<script src="https://raw.githubusercontent.com/summernote/summernote/develop/lang/summernote-es-ES.js"></script>
<script type="text/javascript">
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
</script>
@livewireScripts



@endsection