<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Haz un nuevo Post Oficial</h5>
            <div class="my-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="280" wire:model.lazy="newPost" required>Que estas pensando?</textarea>
                <!-- <div id="summernote"></div> -->
                @if ($photo)
                Previsualizacion de foto:
                <img src="{{ $photo->temporaryUrl() }}" class="img-fluid mx-auto d-block">
                @endif
                <div wire:loading wire:target="photo">Cargando Foto...</div>
                <div wire:loading wire:target="pdf">Cargando PDF...</div>
                @if($pdf)
                PDF cargado correctamente
                @endif
                <div class="d-flex flex-row-reverse my-2">
                    <button type="button" class="btn btn-primary" wire:click="addPost">Postear</button>
                    @if(is_null($photo) && !$pdf)
                    <label for="foto" class="btn btn-primary mb-0 mr-2" alt="Subir foto" data-toggle="tooltip" data-placement="bottom" title="Subir Foto"><b>+ </b><i class="fas fa-image"></i></label>
                    <input type="file" name="" class="d-none" id="foto" accept="image/png, image/jpeg, image/jpg" wire:model="photo">
                    @elseif(!$pdf)
                    <button type="button" class="btn btn-danger mr-2" wire:click="$set('photo', null)">Cancelar</button>
                    @endif
                    @if(is_null($pdf) && !$photo)
                    <label for="pdf" class="btn btn-primary mb-0 mr-2" alt="Subir pdf" data-toggle="tooltip" data-placement="bottom" title="Subir PDF"><b>+ </b><i class="far fa-file-pdf"></i></label>
                    <input type="file" name="" class="d-none" id="pdf" accept="application/pdf" wire:model="pdf">
                    @elseif(!$photo)
                    <button type="button" class="btn btn-danger mr-2" wire:click="$set('pdf', null)">Cancelar</button>
                    @endif
                </div>

            </div>
        </div>
    </div>
</div>