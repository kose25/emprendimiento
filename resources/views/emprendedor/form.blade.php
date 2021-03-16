<div class="row justify-content-center py-4">
    <div class="col-md-4">
        <div class="embed-responsive embed-responsive-1by1 rounded-circle">
            @if(isset($emprendedor->foto))
            <img src="{{ asset('storage').'/'.$emprendedor->foto}}" alt="" class="img-fluid embed-responsive-item" id="profilepic">
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
        <input type="text" class="form-control" name="name" value="{{ isset($emprendedor->name)?$emprendedor->name:'' }}" required autocomplete="name" autofocus placeholder="Nombre">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="apellidos" value="{{ isset($emprendedor->apellidos)?$emprendedor->apellidos:'' }}" autofocus placeholder="Apellidos">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="cedula" value="{{ isset($emprendedor->cedula)?$emprendedor->cedula:'' }}" autofocus placeholder="Cedula">
    </div>
</div>

<div class="form-group row">

    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="celular" value="{{ isset($emprendedor->celular)?$emprendedor->celular:'' }}" autofocus placeholder="Celular">
    </div>
    <div class="col-md-4 py-2">
        <input type="text" class="form-control" name="direccion" value="{{ isset($emprendedor->direccion)?$emprendedor->direccion:'' }}" autofocus placeholder="Direccion">
    </div>





    <div class="col-md-4 py-2">
        <select class="custom-select" name="sexo" required>
            <option value="" disabled selected>Sexo</option>
            <option value="masculino">Masculino</option>
            <option value="femenino">Femenino</option>
            <option value="otro">Otro</option>
        </select>
    </div>
</div>
<div class="form-group row">
    <div class="col-md-4 py-2">
        <input id="email" type="email" class="form-control " name="email" value="{{ isset($emprendedor->email)?$emprendedor->email:'' }}" required autocomplete="email" placeholder="Correo Electronico">
    </div>
    <label for="fechanacimiento" class="col-md-4 col-form-label text-md-right py-2">Fecha de Nacimiento</label>

    <div class="col-md-4 py-2">
        <input id="name" type="date" class="form-control" name="fechanacimiento" value="{{ isset($emprendedor->fechanacimiento)?$emprendedor->fechanacimiento:'' }}" autofocus placeholder="Fecha de Nacimiento">
    </div>
</div>


<div class="form-group row mb-0">
    <div class="col-md-6 offset-md-4">
        <button type="submit" class="btn btn-primary">
            {{$modo}} Emprendedor
        </button>
    </div>
</div>