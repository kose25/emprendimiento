<div>
    @if($emprendimientos)
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
                        <div class="float-right"><button type="button" class="btn btn-primary" data-toggle="modal" data-target="#emprendimientoModal" wire:click="showEmprendimiento({{$emprendimiento->id}})">
                                Ver Detalles
                            </button>
                        </div>
                        <h5>Emprendedor: <a href="{{ url('usuario/'.$emprendimiento->emprendedor->id) }}">{{$emprendimiento->emprendedor->name}}</a></h5>
                        <p class="mb-0">{{$emprendimiento->descripcion}}</p>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    <!-- Modal -->
    <div class="modal fade" id="emprendimientoModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Emprendimiento</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    @if($showEmprendimiento)
                    {{$showEmprendimiento->nombre}}
                    {{$showEmprendimiento->descripcion}}
                    {{$showEmprendimiento->celular}}
                    {{$showEmprendimiento->ciudad}}
                    @endif
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="button" class="btn btn-primary">Save changes</button>
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
                            <div class="col-md-4 text-center">

                                <img src="{{asset('img/emprendimiento.png')}}" alt="" class="profile-user-img img-fluid" id="profilepic">

                                <div wire:loading="" wire:target="foto">Cargando Foto...</div>

                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <label for="fotoperfil" class="btn btn-primary">Subir Foto</label>
                                <input type="file" class="d-none" id="fotoperfil" accept="image/png, image/jpeg, image/jpg" wire:model="foto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="Text" class="form-control" id="nombre" aria-describedby="emailHelp" wire:model.defer="nombre" placeholder="Ingrese Nombre del Emprendimiento" required="" name="name">
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
                            <input type="text" class="form-control" id="ciudad" aria-describedby="emailHelp" wire:model.defer="ciudad" placeholder="Ingrese Ciudad" required name="city">
                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input pattern="[0-9]{10}" class="form-control" id="celular" aria-describedby="emailHelp" wire:model.defer="celular" placeholder="Ingrese numero de celular" type="tel" required name="phone">
                        </div>
                        <div class="form-group">
                            <label for="sector">Sector</label>
                            <select class="custom-select" name="sector" required="" id="sexo" wire:model.defer="sector" name="category">
                                <option value="" disabled="" selected="">Sector</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
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
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" form="emprendimientoform" class="btn btn-primary">Agregar Emprendimiento</button>
                </div>
            </div>
        </div>
    </div>
</div>