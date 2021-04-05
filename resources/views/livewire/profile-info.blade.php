<div class="container-fluid">
    <b>Nombre:</b>
    <p>{{$user->name}}</p>
    <b>Apellidos:</b>
    <p>{{$user->apellidos}}</p>
    <b>Celular:</b>
    <p>{{$user->celular}}</p>
    <b>Sexo:</b>
    <p>{{$user->sexo}}</p>
    <b>Fecha de Nacimiento:</b>
    <p>{{$user->fechanacimiento}}</p>
    <b>Correo:</b>
    <p>{{$user->email}}</p>
    <b>Cargo:</b>
    <p>{{$user->rol}}</p>

    @if(Auth::user()->id==$user->id)
    <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#profileModal" wire:click="edit"> Editar</button>

    <!-- Modal -->
    <div wire:ignore.self class="modal fade" id="profileModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Perfil</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form wire:submit.prevent="save" id="my-form">
                        <div class="row justify-content-center py-4">
                            <div class="col-md-4 text-center">

                                @if($user->foto && !$foto)
                                <img src="{{ asset('storage').'/'.$user->foto}}" alt="" class="profile-user-img img-fluid img-circle" id="profilepic">
                                @elseif(!$user->foto && !$foto)
                                <img src="{{asset('img/profilepic placeholder.jpg')}}" alt="" class="profile-user-img img-fluid img-circle" id="profilepic">
                                @endif
                                @if($foto)
                                <img src="{{$foto->temporaryUrl()}}" alt="" class="profile-user-img img-fluid img-circle" style="object-fit: cover; width:128px; height:128px;" id="profilepic">
                                @endif

                                <div wire:loading wire:target="foto">Cargando Foto...</div>

                            </div>
                        </div>

                        <div class="row justify-content-center">
                            <div class="col-md-4 text-center">
                                <label for="fotoperfil" class="btn btn-primary">Cambiar Foto</label>
                                <input type="file" class="d-none" id="fotoperfil" accept="image/png, image/jpeg, image/jpg" wire:model="foto">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="nombre">Nombre:</label>
                            <input type="Text" class="form-control" id="nombre" aria-describedby="emailHelp" wire:model.defer="nombre" placeholder="Ingrese su nombre" required>
                        </div>
                        <div class="form-group">
                            <label for="apellidos">Apellidos</label>
                            <input type="text" class="form-control" id="apellidos" aria-describedby="emailHelp" wire:model.defer="apellidos" placeholder="Ingrese sus apellidos" required>

                        </div>
                        <div class="form-group">
                            <label for="celular">Celular</label>
                            <input pattern="[0-9]{10}" class="form-control" id="celular" aria-describedby="emailHelp" wire:model.defer="celular" placeholder="Ingrese su numero de celular" type="tel" required>

                        </div>
                        <div class="form-group">
                            <label for="sexo">Sexo</label>
                            <select class="custom-select" name="sexo" required id="sexo" wire:model.defer="sexo">
                                <option value="" disabled selected>Sexo</option>
                                <option value="masculino">Masculino</option>
                                <option value="femenino">Femenino</option>
                                <option value="otro">Otro</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="fechanacimiento">Fecha de Nacimiento</label>
                            <input type="date" class="form-control" id="fechanacimiento" autofocus placeholder="Fecha de Nacimiento" wire:model.defer="date">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Sobre Mi:</label>
                            <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" wire:model.defer="aboutme" maxlength="280"></textarea>
                        </div>

                        <div class="form-group row mb-0 d-none">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Guardar Informacion
                                </button>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal" wire:click="$set('foto', null)">Cerrar</button>
                    <button type="submit" form="my-form" class="btn btn-primary">Guardar Informacion</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>