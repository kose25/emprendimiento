<div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <div class="form-group">
                <div class="input-group input-group-lg">
                    <input type="search" class="form-control form-control-lg" placeholder="Escribe tu busqueda" wire:model="search">
                    <div class="input-group-append">
                        <button type="button" class="btn btn-lg btn-default">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-10 offset-md-1">
            <p>Filtrar por:</p>
            <div class="form-inline">
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio1" value="emprendedor" wire:model="filter">
                    <label class="form-check-label" for="inlineRadio1">Emprendedor</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio2" value="funcionario" wire:model="filter">
                    <label class="form-check-label" for="inlineRadio2">Funcionario</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio3" value="entidad" wire:model="filter">
                    <label class="form-check-label" for="inlineRadio3">Entidad</label>
                </div>
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="inlineRadioOptions" id="inlineRadio4" value="emprendimiento" wire:model="filter">
                    <label class="form-check-label" for="inlineRadio4">Emprendimiento</label>
                </div>

                @if($filter=='emprendimiento')
                <div class="form-group mx-2">
                    <label for="my-select">Por sector:</label>
                    <select id="my-select" class="form-control mx-2" name="" wire:model="sector">
                        <option value="any">Cualquiera</option>
                        @foreach($sectores as $sector)
                        <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                        @endforeach
                    </select>
                </div>
                @endif
            </div>

        </div>
    </div>

    @if($results)
    <div class="row mt-3">
        <div class="col-md-10 offset-md-1">
            <p>@if($search)
                {{$results->total()}} resultados
                @else
                Mostrando en total {{$results->total()}} cuentas de {{$filter}}
                @endif
            </p>
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
                            <button type="button" class="btn btn-primary btn-block" wire:click="follow({{$result->id}})"><b>@if(count($result->seguidores->where('user_id', Auth::user()->id))>0)Dejar de Seguir @else Seguir @endif</b></button>
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

            @if($results->hasPages())
            <div class="d-flex justify-content-center mt-2">
                {{$results->links()}}
            </div>
            @endif
        </div>
    </div>
    @endif

    @if($emprendimientos)
    <div class="row mt-3">
        <div class="col-md-10 offset-md-1">
            <p>{{$emprendimientos->total()}} resultados</p>
            <div class="list-group">
                @foreach($emprendimientos as $emprendimiento)
                <div class="list-group-item">
                    <div class="row">
                        <div class="col-auto">
                            @if($emprendimiento->foto)
                            <img class="img-fluid" src="{{asset('storage').'/'.$emprendimiento->foto}}" alt="Photo" style="max-height: 160px;">
                            @else
                            <img class="img-fluid" src="{{asset('img/emprendimiento.png')}}" alt="Photo" style="max-height: 160px;">
                            @endif
                        </div>
                        <div class="col px-4">
                            <div>
                                <div class="float-right d-none">2021-04-20 10:14pm</div>
                                <h3>{{$emprendimiento->nombre}}</h3>
                                <h5>Emprendedor: <a href="{{ url('usuario/'.$emprendimiento->emprendedor->id) }}">{{$emprendimiento->emprendedor->name}}</a></h5>
                                <p class="mb-0">{{$emprendimiento->descripcion}}</p>
                            </div>
                            <div class="float-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#emprendimientoModal" wire:click="showEmprendimiento({{$emprendimiento->id}})">
                                    Ver Detalles
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
            @if($emprendimientos->hasPages())
            <div class="d-flex justify-content-center mt-2">
                {{$emprendimientos->links()}}
            </div>
            @endif
        </div>
    </div>
    <!-- Modal -->
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
                            <b>Sectores:</b>
                            <br>
                            <p>{{--$showEmprendimiento->sector->nombre--}}</p>
                            <p>{{ $showEmprendimiento->sectores->implode('nombre', ', ') }}</p>

                        </div>
                        <div class="col-6">
                            <b>Actividades Economicas:</b>
                            <br>
                            <p>{{--$showEmprendimiento->actividad->nombre--}}</p>
                            <p>{{ $showEmprendimiento->actividades->implode('nombre', ', ') }}</p>

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
    @endif
</div>