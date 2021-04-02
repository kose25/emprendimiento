@extends('adminlte::page')
@section('title', 'Mi Perfil')

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
                <ul class="nav nav-pills">
                    <li class="nav-item"><a class="nav-link active" href="#activity" data-toggle="tab">Publicaciones</a></li>
                    <li class="nav-item"><a class="nav-link" href="#timeline" data-toggle="tab">Informacion</a></li>
                    <li class="nav-item"><a class="nav-link" href="#settings" data-toggle="tab">Contactos</a></li>
                    <li class="nav-item"><a class="nav-link" href="#networks" data-toggle="tab">Redes</a></li>
                </ul>
            </div><!-- /.card-header -->
            <div class="card-body">
                <div class="tab-content">
                    <div class="active tab-pane" id="activity">
                        <livewire:profilepost :user="$user" />

                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="https://picsum.photos/300/300" alt="user image">
                                <span class="username">
                                    <a href="#">Jonathan Burke Jr.</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Shared publicly - 7:30 PM today</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>

                            <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                <span class="float-right">
                                    <a href="#" class="link-black text-sm">
                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                    </a>
                                </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post clearfix">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="https://picsum.photos/300/300" alt="User Image">
                                <span class="username">
                                    <a href="#">Sarah Ross</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Sent you a message - 3 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <p>
                                Lorem ipsum represents a long-held tradition for designers,
                                typographers and the like. Some people hate it and argue for
                                its demise, but others ignore the hate as they create awesome
                                tools to help create filler text for everyone from bacon lovers
                                to Charlie Sheen fans.
                            </p>

                            <form class="form-horizontal">
                                <div class="input-group input-group-sm mb-0">
                                    <input class="form-control form-control-sm" placeholder="Response">
                                    <div class="input-group-append">
                                        <button type="submit" class="btn btn-danger">Send</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <!-- /.post -->

                        <!-- Post -->
                        <div class="post">
                            <div class="user-block">
                                <img class="img-circle img-bordered-sm" src="https://picsum.photos/300/300" alt="User Image">
                                <span class="username">
                                    <a href="#">Adam Jones</a>
                                    <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                                </span>
                                <span class="description">Posted 5 photos - 5 days ago</span>
                            </div>
                            <!-- /.user-block -->
                            <div class="row mb-3">
                                <div class="col-sm-6">
                                    <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                            <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                        <div class="col-sm-6">
                                            <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                                        </div>
                                        <!-- /.col -->
                                    </div>
                                    <!-- /.row -->
                                </div>
                                <!-- /.col -->
                            </div>
                            <!-- /.row -->

                            <p>
                                <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                                <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                                <span class="float-right">
                                    <a href="#" class="link-black text-sm">
                                        <i class="far fa-comments mr-1"></i> Comments (5)
                                    </a>
                                </span>
                            </p>

                            <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                        </div>
                        <!-- /.post -->
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
                                        <img class="img-circle elevation-2" src="https://picsum.photos/128" alt="User Avatar">
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
    Livewire.on('openmodal', function() {        
        $('#exampleModal').modal('show');
    })
</script>



@endsection