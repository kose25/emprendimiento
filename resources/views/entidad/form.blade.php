<div class="row justify-content-center py-4">
    <div class="col-md-4">
        <div class="embed-responsive embed-responsive-1by1 rounded-circle">
            @if(isset($entidad->foto))
            <img src="{{ asset('storage').'/'.$entidad->foto}}" alt="" class="img-fluid embed-responsive-item" id="profilepic">
            @else
            <img src="https://st3.depositphotos.com/4111759/13425/v/600/depositphotos_134255634-stock-illustration-avatar-icon-male-profile-gray.jpg" alt="" class="img-fluid embed-responsive-item" id="profilepic">
            @endif


        </div>

    </div>
</div>
<div class="row justify-content-center">
    <div class="col-md-4 text-center">
        <label for="foto" class="btn btn-primary">Cambiar Foto</label>
        <input type="file" oninput="profilepic.src=window.URL.createObjectURL(this.files[0])" name="foto" class="d-none" id="foto" accept="image/png, image/jpeg, image/jpg">
    </div>

</div>


<div class="form-group row">

    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="nit" value="{{ isset($entidad->nit)?$entidad->nit:'' }}" autocomplete="name" autofocus placeholder="NIT">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="name" value="{{ isset($entidad->name)?$entidad->name:'' }}" autofocus placeholder="Nombre" required>
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="direccion" value="{{ isset($entidad->direccion)?$entidad->direccion:'' }}" autofocus placeholder="Direccion">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4 py-2">
        <input id="celular" type="text" class="form-control " name="celular" value="{{ isset($entidad->celular)?$entidad->celular:'' }}" autocomplete="celular" placeholder="Celular">
    </div>

    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="email" value="{{ isset($entidad->email)?$entidad->email:'' }}" autofocus placeholder="Email" required>
    </div>
</div>

<div class="form-group row">
    <div class="col-md-12 py-2">
        <textarea class="form-control" name="descripcion" rows="3">{{ isset($entidad->descripcion)?$entidad->descripcion:'Descripcion...' }}</textarea>
    </div>

</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{$modo}} Entidad
        </button>
    </div>
</div>