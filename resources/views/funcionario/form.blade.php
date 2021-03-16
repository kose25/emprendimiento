<div class="form-group row">
    <label for="name" class="col-md-4 col-form-label text-md-right">Nombre</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="name" value="{{ isset($funcionario->name)?$funcionario->name:'' }}" required autocomplete="name" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="apellidos" class="col-md-4 col-form-label text-md-right">Nit</label>

    <div class="col-md-6">
        <input id="nit" type="text" class="form-control" name="nit" value="{{ isset($funcionario->nit)?$funcionario->nit:'' }}" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="direccion" class="col-md-4 col-form-label text-md-right">Direccion</label>

    <div class="col-md-6">
        <input id="direccion" type="text" class="form-control" name="direccion" value="{{ isset($funcionario->direccion)?$funcionario->direccion:'' }}" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="celular" class="col-md-4 col-form-label text-md-right">Celular</label>

    <div class="col-md-6">
        <input id="name" type="text" class="form-control" name="celular" value="{{ isset($funcionario->celular)?$funcionario->celular:'' }}" autofocus>
    </div>
</div>
<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

    <div class="col-md-6">
        <input id="email" type="email" class="form-control " name="email" value="{{ isset($funcionario->email)?$funcionario->email:'' }}" required autocomplete="email">
    </div>
</div>
<div class="form-group row">
    <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion:</label>
    <div class="col-md-6">
        <textarea class="form-control" name="descripcion" rows="3">{{ isset($funcionario->descripcion)?$funcionario->descripcion:'' }}</textarea>
    </div>
</div>
@if(isset($funcionario->foto))
<div class="form-group row justify-content-center">
    <div class="col-md-6">
        <div class="embed-responsive embed-responsive-4by3">
            <img class="embed-responsive-item img-flud" src="{{ asset('storage').'/'.$funcionario->foto}}"></img>
        </div>
    </div>
</div>
@endif
<div class="form-group row">
    <label for="foto" class="col-md-4 col-form-label text-md-right">Foto</label>

    <div class="col-md-6">
        <input id="foto" type="file" class="form-control " name="foto" value="" accept="image/png, image/jpeg, image/jpg">


    </div>
</div>


<div class="form-group row">
    <label for="entidad" class="col-md-4 col-form-label text-md-right">Entidad:</label>
    <div class="col-md-6">
        <select name="entidad">
            @foreach($entidades as $entidad)
            <option value="{{$entidad->id}}" @isset($funcionario) {{ $entidad->id==$entidadxd ? 'selected':'' }} @endisset >{{$entidad->name}} </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{$modo}} Funcionario
        </button>
    </div>
</div>