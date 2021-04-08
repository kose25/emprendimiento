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
        </div>
    </div>

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
                        <div class="float-right">
                            <button type="button" class="btn btn-primary btn-block" wire:click="follow({{$result->id}})"><b>@if(count($result->seguidores->where('user_id', Auth::user()->id))>0)Dejar de Seguir @else Seguir @endif</b></button>
                        </div>
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