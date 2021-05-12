@extends('adminlte::page')
@section('title', 'Promociones')

@section('css')
@livewireStyles
@endsection

@section('content_header')
<h1>Promociones</h1>
@stop
@section('content')
<div class="row">
    @include('layouts.bannerfeed')
    <div class="col-md-6 offset-md-2">
        <livewire:user-feed />

    </div>

</div>

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