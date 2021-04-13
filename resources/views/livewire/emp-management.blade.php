<div class="overflow-auto mb-3" style="height: 500px;">
    @if($emprendimientos && !$selectedEmp)
    <div class="list-group">
        @foreach($emprendimientos as $emprendimiento)
        <div class="list-group-item">
            <div class="row">
                <div class="col-sm-auto col-2 align-self-center">
                    @if($emprendimiento->foto)
                    <img class="img-fluid" src="{{asset('storage').'/'.$emprendimiento->foto}}" alt="Photo" style="max-height: 160px;">
                    @else
                    <img class="img-fluid" src="{{asset('img/emprendimiento.png')}}" alt="Photo" style="max-height: 160px;">
                    @endif
                </div>
                <div class="col px-4">
                    <div>
                        <div class="float-right d-none">2021-04-20 10:14pm</div>
                        <h4><b>{{$emprendimiento->nombre}}</b></h4>
                        <h5>Emprendedor: <a href="{{ url('usuario/'.$emprendimiento->emprendedor->id) }}">{{$emprendimiento->emprendedor->name}}</a></h5>
                        <p class="mb-0">{{$emprendimiento->descripcion}}</p>
                    </div>
                </div>
                <div class="col-12 mt-2">
                    <div class="float-right">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#emprendimientoModal" wire:click="showEmprendimiento({{$emprendimiento->id}})">
                            Ver Detalles
                        </button>
                    </div>
                    <div class="float-right">
                        <button type="button" class="btn btn-primary mr-2" wire:click="team({{$emprendimiento->id}})">
                            Equipo
                        </button>
                    </div>
                </div>

            </div>
        </div>
        @endforeach
        <div class="modal fade" id="emprendimientoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <div class="w-100">
                            @if($showEmprendimiento)
                            <h5 class="modal-title text-center" id="exampleModalLabel">{{$showEmprendimiento->nombre}}</h5>
                            @endif
                        </div>

                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        @if($showEmprendimiento)
                        <div class="row justify-content-center">
                            <div class="col-sm-6 col-5">
                                @if($showEmprendimiento->foto)
                                <img class="img-fluid profile-user-img w-100" src="{{asset('storage').'/'.$showEmprendimiento->foto}}" alt="Photo">
                                @else
                                <img class="img-fluid profile-user-img w-100" src="{{asset('img/emprendimiento.png')}}" alt="Photo">
                                @endif
                            </div>
                        </div>
                        <div class="row m-2">
                            <div class="col-6">
                                <b>Descripcion:</b>
                                <br>
                                <p>{{$showEmprendimiento->descripcion}}</p>
                            </div>
                            <div class="col-6">
                                <b>Email:</b>
                                <br>
                                <p>{{$showEmprendimiento->email}}</p>
                            </div>
                            <div class="col-6">
                                <b>NIT:</b>
                                <br>
                                <p>{{$showEmprendimiento->nit}}</p>
                            </div>
                            <div class="col-6">
                                <b>Ciudad:</b>
                                <br>
                                <p>{{$showEmprendimiento->ciudad}}</p>
                            </div>
                            <div class="col-6">
                                <b>Celular:</b>
                                <br>
                                <p>{{$showEmprendimiento->celular}}</p>
                            </div>
                            <div class="col-6">
                                <b>Fecha Constitucion:</b>
                                <br>
                                <p>{{$showEmprendimiento->fechaconstitucion}}</p>
                            </div>
                            <div class="col-6">
                                <b>Sector:</b>
                                <br>
                                <p>{{$showEmprendimiento->sector}}</p>
                            </div>

                        </div>
                        @endif
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @elseif(!$emprendimientos)
    No tiene Ningun Emprendimiento
    @endif

    @if($selectedEmp)

    <button class="btn btn-primary" type="button" wire:click="setEmp">Atras</button>
    <button class="btn btn-primary" type="button" data-toggle="modal" data-target="#AgregarEMprendedor">Agregar Integrante</button>
    <button class="btn btn-primary" type="button">Crear Integrante</button>
    <!-- Modal -->
    <div class="modal fade" id="AgregarEMprendedor" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Integrante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <div class="form-group">
                        <label for="search">Buscar Integrante</label>
                        <input type="text" class="form-control" id="search" aria-describedby="emailHelp" wire:model="search">
                        @if($results)
                        <div class="row mt-3">
                            <div class="col-md-10 offset-md-1">
                                <p>{{count($results)}} resultados</p>
                                @foreach($results as $result)
                                <div class="row">
                                    <div class="card card-widget widget-user-2  w-100">
                                        <!-- Add the bg color to the header using any of the bg-* classes -->
                                        <div class="widget-user-header">
                                            <div class="widget-user-image">
                                                @if($result->foto)
                                                <img class="img-circle elevation-2" src="{{asset('storage').'/'.$result->foto}}" alt="User Avatar">
                                                @else
                                                <img class="img-circle elevation-2" src="{{asset('img/profilepic placeholder.jpg')}}" alt="User Avatar">
                                                @endif
                                            </div>
                                            <!-- /.widget-user-image -->
                                            <h3 class="widget-user-username"><a href="{{ url('usuario/'.$result->id) }}">{{$result->name}} {{$result->apellidos}}</a></h3>
                                            @if(Auth::user()->id!=$result->id)
                                            <div class="float-right">
                                                <button type="button" class="btn btn-primary btn-block" wire:click="add({{$result->id}})"><b>@if(count($result->equipos->where('user_id', $result->id)->where('emprendimiento_id', $selectedEmp->id))>0)Quitar @else Agregar @endif</b></button>
                                            </div>
                                            @endif
                                            <h5 class="widget-user-desc">{{$result->rol}}</h5>
                                            <h6 class="widget-user-desc"><b>{{count($result->seguidores)}}</b> Seguidores</h6>
                                            <h6 class="widget-user-desc"><b>{{count($result->posts)}}</b> Publicaciones</h6>
                                            @if(count($result->seguidos->where('follows', Auth::user()->id))>0)
                                            <h6 class="widget-user-desc">Te Sigue</h6>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <table class="table">
        <thead>
            <tr>
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Apellido</th>
                <th scope="col">Perfil</th>
                <th scope="col">Accion</th>
            </tr>
        </thead>
        <tbody>
            @if($selectedEmp->integrantes->count()>0)
            @foreach($selectedEmp->integrantes as $integrante)
            <tr>
                <th scope="row">{{$loop->index + 1}}</th>
                <td>{{$integrante->user->name}}</td>
                <td>{{$integrante->user->apellidos}}</td>
                <td><a href="{{url('usuario/'.$integrante->user_id)}}">Ver Perfil</a></td>
                <td><button class="btn btn-danger" type="button" wire:click="add({{$integrante->user_id}})">Quitar</button></td>
            </tr>
            @endforeach
            @else
            <tr>
                <td colspan="3">Aun no tiene integrantes</td>
            </tr>
            @endif
        </tbody>
    </table>
    @endif

</div>