<div class="row justify-content-center py-4">
    <div class="col-md-4">
        <div class="embed-responsive embed-responsive-1by1 rounded-circle">
            @if(isset($emprendimiento->foto))
            <img src="{{ asset('storage').'/'.$emprendimiento->foto}}" alt="" class="img-fluid embed-responsive-item" id="profilepic">
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
        <input type="text" class="form-control" name="nit" value="{{ isset($emprendimiento->nit)?$emprendimiento->nit:'' }}" required autocomplete="name" autofocus placeholder="NIT">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="nombre" value="{{ isset($emprendimiento->nombre)?$emprendimiento->nombre:'' }}" autofocus placeholder="Nombre">
    </div>
    <div class="col-md-4 py-2">
        <input type="email" class="form-control" name="email" value="{{ isset($emprendimiento->email)?$emprendimiento->email:'' }}" autofocus placeholder="Email">
    </div>
</div>

<div class="form-group row">

    <div class="col-md-4 py-2">
        <select name="lider" required class="custom-select">
            <option value="" disabled selected>Lider</option>
            @foreach($emprendedores as $emprendedor)
            <option value="{{$emprendedor->id}}" @isset($emprendimiento) {{ $emprendimiento->lider==$emprendedor->id ? 'selected':'' }} @endisset>{{$emprendedor->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="ciudad" value="{{ isset($emprendimiento->ciudad)?$emprendimiento->ciudad:'' }}" autofocus placeholder="Ciudad">
    </div>

    <div class="col-md-4 py-2">
        <select class="custom-select" name="sector" required>
            <option value="" disabled selected>Sector</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>
    </div>


</div>
<div class="form-group row">
    <div class="col-md-4 py-2">
        <input id="celular" type="text" class="form-control " name="celular" value="{{ isset($emprendimiento->celular)?$emprendimiento->celular:'' }}" required autocomplete="celular" placeholder="Celular">
    </div>
    <label for="fechanacimiento" class="col-md-4 col-form-label text-md-right py-2">Fecha de Constitucion</label>

    <div class="col-md-4 py-2">
        <input id="name" type="date" class="form-control" name="fechaconstitucion" value="{{ isset($emprendedor->fechaconstitucion)?$emprendedor->fechaconstitucion:'' }}" autofocus placeholder="Fecha de Constitucion">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4 py-2">
        <textarea class="form-control" name="descripcion" rows="3">{{ isset($emprendimiento->descripcion)?$emprendimiento->descripcion:'Descripcion...' }}</textarea>
    </div>
    <div class="col-md-4 py-2">
        <select name="entidad" required class="custom-select">
            <option value="" disabled selected>Entidad</option>
            @foreach($entidades as $entidad)
            <option value="{{$entidad->id}}" @isset($emprendimiento) {{ $entidad->id==$emprendimiento->entidad ? 'selected':'' }} @endisset>{{$entidad->name}}</option>
            @endforeach
        </select>


    </div>
    <div class="col-md-4 py-2">
    </div>    
</div>

<div class="form-group row mb-0">
        <div class="col-md-6 offset-md-4">
            <button type="submit" class="btn btn-primary">
                {{$modo}} Emprendimiento
            </button>
        </div>
    </div>