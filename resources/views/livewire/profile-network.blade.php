<div class="overflow-auto" style="height: 380px;">
    <div class="container">
        <div class="row">

            <div class="col-12 mb-4">
                @if($user->network)
                <ul class="list-group list-group-flush">

                    @if($user->network->facebook)<li class="list-group-item"><a href="{{$user->network->facebook}}" target="_blank"><i class="fab fa-facebook"></i> Facebook</a></li>@endif
                    @if($user->network->instagram)<li class="list-group-item"><a href="{{$user->network->instagram}}" target="_blank"><i class="fab fa-instagram"></i> Instagram</a></li>@endif
                    @if($user->network->linkedin)<li class="list-group-item"><a href="{{$user->network->linkedin}}" target="_blank"><i class="fab fa-linkedin"></i> Linkedin</a></li>@endif
                    @if($user->network->twitter)<li class="list-group-item"><a href="{{$user->network->twitter}}" target="_blank"><i class="fab fa-twitter"></i> Twitter</a></li>@endif
                </ul>
                @if(!$user->network->facebook && !$user->network->instagram && !$user->network->linkedin && !$user->network->twitter)
                No hay Redes asociadas
                @endif
                @else
                <p>Aun no tiene redes asociadas</p>
                @endif
            </div>

            @if(Auth::user()->id==$user->id)
            <button type="button" class="btn btn-primary ml-4" data-toggle="modal" data-target="#exampleModal"> Editar</button>
            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel">Redes</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form wire:submit.prevent="saveNetwork" id="networkform">
                                <div class="form-group">
                                    <label for="facebook">Facebook</label>
                                    <input type="url" class="form-control" id="facebook" aria-describedby="emailHelp" wire:model.defer="facebook" placeholder="Enlace de su perfil de FB" pattern="https://www.facebook.com.*">

                                </div>
                                <div class="form-group">
                                    <label for="instagram">Instagram</label>
                                    <input type="url" class="form-control" id="instagram" aria-describedby="emailHelp" wire:model.defer="instagram" placeholder="Enlace de su perfil de Instagram" pattern="https://www.instagram.com.*">

                                </div>
                                <div class="form-group">
                                    <label for="linkedin">Linkedin</label>
                                    <input type="url" class="form-control" id="linkedin" aria-describedby="emailHelp" wire:model.defer="linkedin" placeholder="Enlace de su perfil de Linkedin" pattern="https://www.linkedin.com.*">

                                </div>
                                <div class="form-group">
                                    <label for="twitter">Twitter</label>
                                    <input type="url" class="form-control" id="twitter" aria-describedby="emailHelp" wire:model.defer="twitter" placeholder="Enlace de su perfil de Twitter" pattern="https://twitter.com.*">

                                </div>
                                <button type="submit" class="btn btn-primary d-none">Guardar Cambios</button>
                            </form>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-secondary d-none" data-dismiss="modal">Close</button>
                            <button type="submit" form="networkform" class="btn btn-primary">Guardar Informacion</button>
                        </div>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>

</div>