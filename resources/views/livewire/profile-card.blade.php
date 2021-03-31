<div>
    <div class="text-center">
        <img class="profile-user-img img-fluid img-circle" src="https://picsum.photos/300/300" alt="User profile picture">
    </div>

    <h3 class="profile-username text-center">{{$user->name}}</h3>

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