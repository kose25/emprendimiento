<div>
    <div class="text-center">
        @if($user->foto)
        <img class="profile-user-img img-fluid img-circle" style="object-fit: cover; width:100px; height:100px;" src="{{asset('storage').'/'.$user->foto}}" alt="User profile picture">
        @else
        <img class="profile-user-img img-fluid img-circle"  style="object-fit: cover; width:100px; height:100px;" src="{{asset('img/profilepic placeholder.jpg')}}" alt="User profile picture">
        @endif
    </div>

    <h3 class="profile-username text-center">{{$user->name}} {{$user->apellidos}}</h3>

    <p class="text-muted text-center">{{Str::ucfirst($user->rol)}}</p>

    <ul class="list-group list-group-unbordered mb-3">
        <li class="list-group-item">
            <b>Seguidores</b> <a class="float-right">{{count($user->seguidores)}}</a>
        </li>
        <li class="list-group-item">
            <b>Siguiendo</b> <a class="float-right">{{count($user->seguidos)}}</a>
        </li>
        <li class="list-group-item">
            <b>Publicaciones</b> <a class="float-right">{{count($user->posts)}}</a>
        </li>
    </ul>
    @if(Auth::user()->id!=$user->id)
    <button type="button" class="btn btn-primary btn-block" wire:click="follow"><b>{{$button}}</b></button>
    @endif
</div>