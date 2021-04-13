@extends('adminlte::page')
@section('title', 'Equipo')

@section('css')
@livewireStyles
@endsection

@section('content_header')
<h1>Tus Emprendimientos</h1>
@stop
@section('content')

<h1>Contenido</h1>
<div class="row justify-content-md-center">
    <div class="col-md-8">
        <livewire:emp-management />
    </div>
</div>

@stop

@section('js')
@livewireScripts



@endsection