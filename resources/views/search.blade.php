@extends('adminlte::page')
@section('title', 'Buscar')

@section('css')
@livewireStyles
@endsection

@section('content_header')
<h1>Busqueda</h1>
@stop
@section('content')

<livewire:search />

@stop

@section('js')
<script type="text/javascript">
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
</script>
@livewireScripts



@endsection