<div class="form-group row">
    <label for="nombre" class="col-md-4 col-form-label text-md-right">Nombre</label>
    <div class="col-md-6">
        <input id="nombre" type="text" class="form-control" name="nombre" value="{{ isset($emprendimiento->nombre)?$emprendimiento->nombre:'' }}" required autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="descripcion" class="col-md-4 col-form-label text-md-right">Descripcion:</label>
    <div class="col-md-6">
        <textarea class="form-control" name="descripcion" rows="3">{{ isset($emprendimiento->descripcion)?$emprendimiento->descripcion:'' }}</textarea>
    </div>
</div>

<div class="form-group row">
    <label for="email" class="col-md-4 col-form-label text-md-right">Email:</label>
    <div class="col-md-6">
        <input id="email" type="email" class="form-control" name="email" value="{{ isset($emprendimiento->email)?$emprendimiento->email:'' }}" required autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="nit" class="col-md-4 col-form-label text-md-right">NIT:</label>
    <div class="col-md-6">
        <input id="nit" type="text" class="form-control" name="nit" value="{{ isset($emprendimiento->nit)?$emprendimiento->nit:'' }}" required autofocus>
    </div>
</div>

<div class="form-group row">
    <label for="ciudad" class="col-md-4 col-form-label text-md-right">Ciudad</label>
    <div class="col-md-6">
        <input id="ciudad" type="text" class="form-control" name="ciudad" value="{{ isset($emprendimiento->ciudad)?$emprendimiento->ciudad:'' }}" required autofocus>
    </div>
</div>


@if(isset($emprendimiento->foto))
<div class="form-group row justify-content-center">
    <div class="col-md-6">
        <div class="embed-responsive embed-responsive-4by3">
            <img class="embed-responsive-item img-flud" src="{{ asset('storage').'/'.$emprendimiento->foto}}"></img>
        </div>
    </div>
</div>
@endif

<div class="form-group row ">
    <label for="foto" class="col-md-4 col-form-label text-md-right">Foto:</label>
    <div class="col-md-6">
        <input id="foto" type="file" class="form-control" name="foto" value="" autofocus accept="image/png, image/jpeg, image/jpg">
    </div>
</div>

<div class="form-group row">
    <label for="lider" class="col-md-4 col-form-label text-md-right">Emprendedor:</label>
    <div class="col-md-6">
        <select name="lider">
            @foreach($emprendedores as $emprendedor)
            <option value="{{$emprendedor->id}}" @isset($emprendimiento) {{ $emprendimiento->lider==$emprendedor->id ? 'selected':'' }} @endisset >{{$emprendedor->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row">
    <label for="entidad" class="col-md-4 col-form-label text-md-right">Entidad:</label>
    <div class="col-md-6">
        <select name="entidad">
            @foreach($entidades as $entidad)
            <option value="{{$entidad->id}}" @isset($emprendimiento) {{ $entidad->id==$emprendimiento->entidad ? 'selected':'' }}  @endisset >{{$entidad->name}}</option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{$modo}}
        </button>
    </div>
</div>



<!-- <label for="nombre">Nombre</label>
<input type="text" name="nombre" value="{{ isset($emprendimiento->nombre)?$emprendimiento->nombre:'' }}"> <br>
<label for="descripcion">Descripcion:</label>
<input type="text" name="descripcion" value="{{ isset($emprendimiento->descripcion)?$emprendimiento->descripcion:'' }}"> <br>
<label for="email">Email</label>
<input type="text" name="email" value="{{ isset($emprendimiento->email)?$emprendimiento->email:'' }}"> <br>
<label for="nit">Nit</label>
<input type="text" name="nit" value="{{ isset($emprendimiento->nit)?$emprendimiento->nit:'' }}"> <br>
<label for="ciudad">Ciudad</label>
<input type="text" name="ciudad" value="{{ isset($emprendimiento->ciudad)?$emprendimiento->ciudad:'' }}"> <br>
<label for="foto">Foto</label>
<input type="text" name="foto" value="{{ isset($emprendimiento->foto)?$emprendimiento->foto:'' }}"> <br>
<label for="emprendedor">Emprendedor</label>
<select name="lider">
    @foreach($emprendedores as $emprendedor)
    <option value="{{$emprendedor->id}}">{{$emprendedor->name}}</option>
    @endforeach
</select>
<br>
<label for="entidad">Entidad</label>
<select name="entidad">
    @foreach($entidades as $entidad)
    <option value="{{$entidad->id}}">{{$entidad->name}}</option>
    @endforeach
</select>
<br>
<input type="submit" value="{{$modo}}">
<br>
<a href="{{ url('emprendimiento/') }}">Ver Emprendimiento</a> -->