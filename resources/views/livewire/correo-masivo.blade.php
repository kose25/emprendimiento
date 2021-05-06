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
                    <label>Contenido:</label>
                    <div wire:ignore>
                        <trix-editor class="trix-content" x-ref="trix" wire:model.debounce.999999ms="body"></trix-editor>
                    </div>
                    {{--<input id="x" type="hidden" name="content" wire:model="body" value="">
                    <trix-editor input="x"></trix-editor>--}}
                    <button type="submit" class="btn btn-primary my-3" id="fire">Enviar Correo</button>
                </form>
            </div>

        </div>
    </div>

</div>