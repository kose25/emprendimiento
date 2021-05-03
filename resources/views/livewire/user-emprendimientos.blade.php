<div>
    @if($emprendimientos)
    <div class="list-group">
        @foreach($emprendimientos as $emprendimiento)
        <div class="list-group-item">
            @if(Auth::User()->id==$user->id)
            <a href="#" class="float-right btn-tool mt-3" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                <button class="dropdown-item" wire:click="delete({{$emprendimiento->id}})" onclick="return confirm('¿Quieres Borrar el Emprendimiento?')">Eliminar</button>
            </div>
            @endif
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
                    <div class="float-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#emprendimientoModal" wire:click="showEmprendimiento({{$emprendimiento->id}})">
                            Ver Detalles
                        </button>
                    </div>
                    @if(Auth::User()->id==$user->id)
                    <div class="float-right mr-2">
                        <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#editEmprendimiento" wire:click="edit({{$emprendimiento->id}})">
                            Editar
                        </button>
                    </div>
                    @endif
                </div>

            </div>
        </div>
        @endforeach
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

                    </div>
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
    @else
    NO tiene emprendimientos
    @endif

    <!-- Modal -->
    <div class="modal fade" id="crearEmprendimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Crear Nuevo Emprendimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save" id="emprendimientoform">
                        <div class="row justify-content-center py-4">
                            <div class="col-md-6 text-center">
                                @if($foto && !is_string($foto))
                                <img class="profile-user-img img-fluid" src="{{ $foto->temporaryUrl() }}" style="object-fit: cover; width:200px; height:200px;"></img>
                                @else
                                <img src="{{asset('img/emprendimiento.png')}}" alt="" class="profile-user-img img-fluid" id="profilepic" style="width: 200px;">
                                @endif
                                <div wire:loading="" wire:target="foto">Cargando Foto...</div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <label for="fotoemprendimiento" class="btn btn-primary">Subir Foto</label>
                                <input type="file" class="d-none" id="fotoemprendimiento" accept="image/png, image/jpeg, image/jpg" wire:model="foto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="Text" class="form-control" id="nombre" aria-describedby="emailHelp" wire:model="nombre" placeholder="Ingrese Nombre del Emprendimiento" required="" name="name">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="descripcion" maxlength="300" required name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email de emprendimiento:</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" wire:model.defer="email" placeholder="Ingrese email" required name="email">
                        </div>
                        <div class="form-group">
                            <label for="nit">NIT:</label>
                            <input type="text" class="form-control" id="nit" aria-describedby="emailHelp" wire:model.defer="nit" placeholder="Ingrese nit" required name="nit">
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" class="form-control" id="ciudad" aria-describedby="emailHelp" wire:model.defer="ciudad" placeholder="Ingrese Ciudad" required name="city" wire.model.defer="ciudad">
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular:</label>
                            <input pattern="[0-9]{10}" class="form-control" id="celular" aria-describedby="emailHelp" wire:model.defer="celular" placeholder="Ingrese numero de celular" type="tel" required name="phone">
                        </div>
                        <div class="form-group">
                            <label for="sectorxdxd">Sector</label>
                            <div wire:ignore>
                                <select class="selectpicker" name="sector" required id="sectorxdxd" wire:model.defer="sectorxd" multiple data-live-search="true" title="Elige 1 o hasta 3 sectores" data-width="75%">
                                    @foreach($sectores as $sector)
                                    <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sector">Entidad</label>
                            <select class="custom-select" name="entidad" required id="entidad" wire:model.defer="entidad" name="entidad">
                                <option value="" disabled="" selected="">Entidad</option>
                                @foreach($entidades as $entidad)
                                <option value="{{$entidad->id}}">{{$entidad->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fechaconstitucion">Fecha de Constitucion</label>
                            <input type="date" class="form-control" id="fechaconstitucion" autofocus="" placeholder="Fecha de constitucion" wire:model.defer="fechaconstitucion">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="cerrar">Cerrar</button>
                    <button type="submit" form="emprendimientoform" class="btn btn-primary">Agregar Emprendimiento</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="editEmprendimiento" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Emprendimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="update" id="editemprendimientoform">
                        <div class="row justify-content-center py-4">
                            <div class="col-md-6 text-center">
                                @if($newfoto)
                                <img class="profile-user-img img-fluid" src="{{ $newfoto->temporaryUrl() }}" style="object-fit: cover; width:200px; height:200px;"></img>
                                @elseif($foto)
                                <img src="{{asset('storage').'/'.$foto}}" alt="" class="profile-user-img img-fluid" style="width: 200px;">
                                @else
                                <img src="{{asset('img/emprendimiento.png')}}" alt="" class="profile-user-img img-fluid" style="width: 200px;">
                                @endif
                                <div wire:loading="" wire:target="newfoto">Cargando Foto...</div>
                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <label for="editfotoemprendimiento" class="btn btn-primary">Cambiar Foto</label>
                                <input type="file" class="d-none" id="editfotoemprendimiento" accept="image/png, image/jpeg, image/jpg" wire:model="newfoto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="Text" class="form-control" id="nombre" aria-describedby="emailHelp" wire:model="nombre" placeholder="Ingrese Nombre del Emprendimiento" required="" name="name">

                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripcion:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="descripcion" maxlength="300" required name="description"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="email">Email de emprendimiento:</label>
                            <input type="email" class="form-control" id="email" aria-describedby="emailHelp" wire:model.defer="email" placeholder="Ingrese email" required name="email">
                        </div>
                        <div class="form-group">
                            <label for="nit">NIT:</label>
                            <input type="text" class="form-control" id="nit" aria-describedby="emailHelp" wire:model.defer="nit" placeholder="Ingrese nit" required name="nit">
                        </div>
                        <div class="form-group">
                            <label for="ciudad">Ciudad:</label>
                            <input type="text" class="form-control" id="ciudad" aria-describedby="emailHelp" wire:model.defer="ciudad" placeholder="Ingrese Ciudad" required name="city" wire.model.defer="ciudad">
                        </div>
                        <div class="form-group">
                            <label for="celularedit">Celular</label>
                            <input pattern="[0-9]{10}" class="form-control" id="celularedit" aria-describedby="emailHelp" wire:model.defer="celular" placeholder="Ingrese numero de celular" type="tel" required name="phone">

                        </div>
                        <div class="form-group">
                            <label for="sectorxdeditf">Sector</label>
                            <div wire:ignore>
                                <select class="selectpicker" required id="sectorxdeditf" wire:model.defer="sector" multiple data-width="75%" title="Seleccione 1 o hasta 3 sectores" data-live-search="true">
                                    @foreach($sectores as $sector)
                                    <option value="{{$sector->id}}">{{$sector->nombre}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="sector">Entidad</label>
                            <select class="custom-select" name="entidad" required id="entidad" wire:model.defer="entidad" name="entidad">
                                <option value="" disabled="" selected="">Entidad</option>
                                @foreach($entidades as $entidad)
                                <option value="{{$entidad->id}}">{{$entidad->name}}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fechaconstitucion">Fecha de Constitucion</label>
                            <input type="date" class="form-control" id="fechaconstitucion" autofocus="" placeholder="Fecha de constitucion" wire:model.defer="fechaconstitucion">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="cerrar">Cerrar</button>
                    <button type="submit" form="editemprendimientoform" class="btn btn-primary">Editar Emprendimiento</button>
                </div>
            </div>
        </div>
    </div>
</div>