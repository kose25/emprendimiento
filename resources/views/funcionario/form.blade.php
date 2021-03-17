<div class="row justify-content-center py-4">
    <div class="col-md-4">
        <div class="embed-responsive embed-responsive-1by1 rounded-circle">
            @if(isset($funcionario->foto))
            <img src="{{ asset('storage').'/'.$funcionario->foto}}" alt="" class="img-fluid embed-responsive-item" id="profilepic">
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
        <input type="text" class="form-control" name="nit" value="{{ isset($funcionario->nit)?$funcionario->nit:'' }}" required autocomplete="name" autofocus placeholder="NIT">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="name" value="{{ isset($funcionario->name)?$funcionario->name:'' }}" autofocus placeholder="Nombre">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="direccion" value="{{ isset($funcionario->direccion)?$funcionario->direccion:'' }}" autofocus placeholder="Direccion">
    </div>
</div>

<div class="form-group row">
    <div class="col-md-4 py-2">
        <input id="celular" type="text" class="form-control " name="celular" value="{{ isset($funcionario->celular)?$funcionario->celular:'' }}" required autocomplete="celular" placeholder="Celular">
    </div>

    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="email" value="{{ isset($funcionario->email)?$funcionario->email:'' }}" autofocus placeholder="Email">
    </div>

    <div class="col-md-4 py-2">
        <select name="entidad" required class="custom-select">
            <option value="" disabled selected>Entidad</option>
            @foreach($entidades as $entidad)
            <option value="{{$entidad->id}}" @isset($funcionario) {{ $entidad->id==$entidadxd ? 'selected':'' }} @endisset >{{$entidad->name}} </option>
            @endforeach
        </select>
    </div>


</div>

<div class="form-group row">
    <div class="col-md-12 py-2">
        <textarea class="form-control" name="descripcion" rows="3">{{ isset($funcionario->descripcion)?$funcionario->descripcion:'Descripcion...' }}</textarea>
    </div>

</div>

<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{$modo}} Funcionario
        </button>
    </div>
</div>