<div>
    <div class="card card-primary">
        <div class="card-header">
            <h3 class="card-title">Cambiar Contraseña</h3>
        </div>
        <!-- /.card-header -->
        <!-- form start -->
        <form wire:submit.prevent="changePassword">
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Contraseña Actual:</label>
                    <input type="password" class="form-control" id="exampleInputEmail1" placeholder="Ingrese Contraseña Actual" minlength="8" required wire:model.defer="currentPassword">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Nueva Contraseña:</label>
                    <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Nueva Contraseña" minlength="8" required wire:model="newPassword_confirmation">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword2">Confirme Nueva Contraseña:</label>
                    <input type="password" class="form-control" id="exampleInputPassword2" placeholder="Confirme nueva contraseña" minlength="8" required wire:model="newPassword">
                    @error('newPassword') <div class="text-danger">
                        <small>{{$message}}</small>
                    </div> @enderror
                </div>
                <input type="checkbox" onclick="myFunction()">Show Password
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Guardar Cambios</button>
            </div>
        </form>
    </div>
</div>