<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Envie Correo</h5>
            <div class="card-text">
                <form wire:submit.prevent="send">
                    <div class="form-group">
                        <label for="my-asunto">Asunto:</label>
                        <input id="my-asunto" class="form-control" type="text" name="" wire:model.defer="subject" required placeholder="ingrese el asunto del correo">
                    </div>
                    <label for="">Contenido:</label>
                    <div wire:ignore>
                        <trix-editor class="trix-content" x-ref="trix" wire:model.defer="body" wire:key="uniqueKey"></trix-editor>
                    </div>
                    <button type="submit" class="btn btn-primary my-3" id="fire">Enviar Correo</button>
                </form>
            </div>

        </div>
    </div>

</div>