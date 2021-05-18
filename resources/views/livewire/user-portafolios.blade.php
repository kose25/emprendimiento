<div>
    <div class="overflow-auto mb-3" style="height: 380px;">
        <div class="list-group">
            @if($portafolios)
            @foreach($portafolios as $portafolio)
            <div class="list-group-item">
                <div class="row">
                    <div class="col-sm-auto col-2 align-self-center">
                        <i class="far fa-file-pdf fa-7x"></i>
                    </div>
                    <div class="col px-4">
                        <div>
                            <div class="float-right d-none">2021-04-20 10:14pm</div>
                            <h4><b>{{$portafolio->nombre}}</b></h4>
                            <h5><a href="{{asset('storage').'/'.$portafolio->ruta}}" target="_blank">Ver Portafolio</a></h5>
                        </div>
                    </div>
                    <div class="col-12 mt-2">
                        @if(Auth::User()->id==$user->id)
                        <div class="float-right mr-2">
                            <button type="button" class="btn btn-primary" wire:click="delete({{$portafolio->id}})" onclick="return confirm('¿Quieres Borrar el portafolio?')">
                                Borrar
                            </button>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
            @endforeach
            @else
            No tiene Portafolios
            @endif
        </div>
    </div>
    @if($user->id==Auth::user()->id)
    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#crearPortafolio">
        Agregar Portafolio
    </button>
    <!-- Modal -->
    <div class="modal fade" id="crearPortafolio" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true" wire:ignore.self>
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Agregar Portafolio</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="portafolioform" wire:submit.prevent="save">
                        <div class="form-group">
                            <label for="nombrepdf">Nombre del Portafolio:</label>
                            <input type="text" class="form-control" id="nombrepdf" aria-describedby="emailHelp" wire:model="nombre" placeholder="Ingrese Nombre del Portafolio" required name="name">
                        </div>
                        <div class="form-group">
                            <label for="portafoliopdf">PDF Portafolio:</label>
                            <input type="file" class="form-control" id="portafoliopdf" aria-describedby="emailHelp" wire:model="pdf" placeholder="Seleccione archivo" required name="pdf" accept="application/pdf">
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
                    <button type="submit" form="portafolioform" class="btn btn-primary">Guardar Cambios</button>
                </div>
            </div>
        </div>
    </div>
    @endif
</div>