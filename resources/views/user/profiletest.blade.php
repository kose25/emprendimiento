@extends('adminlte::page')
@section('title', $user->name)

@section('css')
<script src="//cdn.jsdelivr.net/npm/sweetalert2@10"></script>
@livewireStyles
@endsection

@section('content')

<div class="row">
    <div class="col-md-3">

        <!-- Profile Image -->
        <div class="card card-primary card-outline">
            <div class="card-body box-profile">
                <livewire:profile-card :user="$user" />
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->

        <!-- About Me Box -->
        <div class="card card-primary">
            <div class="card-header">
                <h3 class="card-title">Sobre mi</h3>
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <p class="text-muted">
                    {{$user->aboutme}}
                </p>


            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
    <div class="col-md-9">
        <div class="card">
            <div class="card-header p-2">
                <ul class="nav nav-pills nav-fill">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Publicaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Informacion</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Contactos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#networks" data-toggle="tab">Redes</a></li>
                    @if($user->rol=='emprendedor')
                    <li class="nav-item"><a class="nav-link" href="#portafolios" data-toggle="tab">Portafolios</a></li>
                    <li class="nav-item"><a class="nav-link" href="#emprendimientos" data-toggle="tab">Emprendimientos</a></li>
                    @endif
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <livewire:profilepost :user="$user" />
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="timeline">
                        <livewire:profile-info :user="$user" />
                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="settings">
                        <div class="overflow-auto" style="height: 380px;">
                            @if(count($user->seguidos)>0)
                            @foreach($user->seguidos as $seguido)
                            <div class="card card-widget widget-user-2">
                                <!-- Add the bg color to the header using any of the bg-* classes -->
                                <div class="widget-user-header">
                                    <div class="widget-user-image">
                                        @if($seguido->seguido->foto)
                                        <img class="img-circle elevation-2" src="{{asset('storage').'/'.$seguido->seguido->foto}}" alt="User Avatar">
                                        @else
                                        <img class="img-circle elevation-2" src="{{asset('img/profilepic placeholder.jpg')}}" alt="User Avatar">
                                        @endif
                                    </div>
                                    <!-- /.widget-user-image -->
                                    <h3 class="widget-user-username"><a href="{{ url('usuario/'.$seguido->seguido->id)}}">{{$seguido->seguido->name}}</a></h3>
                                    <h5 class="widget-user-desc">{{$seguido->seguido->rol}}</h5>
                                    <h6 class="widget-user-desc"><b>{{count($seguido->seguido->seguidores)}}</b> Seguidores</h5>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <p>este perfil no sigue a nadie aun</p>
                            @endif
                        </div>

                    </div>
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="networks">
                        <div class="overflow-auto" style="height: 380px;">
                            <livewire:profile-network :user="$user" />
                        </div>
                    </div>
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="portafolios">
                        <livewire:user-portafolios :user="$user" />
                    </div>
                    <!-- /.tab-pane -->
                    <!-- /.tab-pane -->
                    <div class="tab-pane" id="emprendimientos">
                        <div class="overflow-auto mb-3" style="height: 380px;">
                            <livewire:user-emprendimientos :user="$user" />
                        </div>
                        @if($user->id==Auth::user()->id)
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearEmprendimiento">
                            Crear Emprendimiento
                        </button>
                        @endif
                    </div>
                    <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
            </div><!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
    <!-- /.col -->
</div>



@stop

@section('js')

<script type="text/javascript">
    $(function() {
        $('[data-toggle="tooltip"]').tooltip()
    })
</script>
<script type="text/javascript">
    window.onscroll = function(ev) {
        if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {
            window.livewire.emit('load-more');
        }
    };
</script>

@livewireScripts

<script>
    Livewire.on('alert', function() {
        Swal.fire(
            'Cambios Guardados Correctamente',
            'Sus redes se guardaron correctamente',
            'success'
        )
        $('#exampleModal').modal('hide');
    })
    Livewire.on('profile updated', function() {
        Swal.fire(
            'Cambios Guardados Correctamente',
            'Sus informacion de perfil se guardo correctamente',
            'success'
        )
        $('#profileModal').modal('hide');
    })
    Livewire.on('emprendimiento added', function() {
        Swal.fire(
            'Cambios Guardados Correctamente',
            'Emprendimiento agregado exitosamente',
            'success'
        )
        $('#crearEmprendimiento').modal('hide');
    })
    Livewire.on('empDeleted', function() {
        Swal.fire(
            'Emprendimiento Borrado',
            'Emprendimiento Borrado exitosamente',
            'success'
        )

    })
    Livewire.on('empUpdated', function() {
        Swal.fire(
            'Cambios Guardados Correctamente',
            'Emprendimiento Editado exitosamente',
            'success'
        )
        $('#editEmprendimiento').modal('hide');
    })
    Livewire.on('portafolio saved', function() {
        Swal.fire(
            'Cambios Guardados Correctamente',
            'Portafolio creado exitosamente',
            'success'
        )
        $('#crearPortafolio').modal('hide');
    })
    Livewire.on('portafolio deleted', function() {
        Swal.fire(
            'Cambios Guardados Correctamente',
            'Portafolio borrado exitosamente',
            'success'
        )
    })
</script>



@endsection