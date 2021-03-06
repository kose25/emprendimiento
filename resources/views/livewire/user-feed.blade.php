<div>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Haz un nuevo Post</h5>
            <div class="my-2">
                <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="280" wire:model.lazy="newPost" required placeholder="Que estas Pensando?"></textarea>

                @if ($photo)
                Previsualizacion de foto:
                <img src="{{ $photo->temporaryUrl() }}" class="img-fluid mx-auto d-block">
                @endif
                <div wire:loading wire:target="photo">Cargando Foto...</div>
                <div wire:loading wire:target="pdf">Cargando PDF...</div>
                @if($pdf)
                PDF cargado correctamente
                @endif
                <div class="d-flex flex-row-reverse my-2">
                    <button type="button" class="btn btn-primary" wire:click="addPost">Postear</button>
                    @if(is_null($photo) && !$pdf)
                    <label for="foto" class="btn btn-primary mb-0 mr-2" alt="Subir foto" data-toggle="tooltip" data-placement="bottom" title="Subir Foto"><b>+ </b><i class="fas fa-image"></i></label>
                    <input type="file" name="" class="d-none" id="foto" accept="image/png, image/jpeg, image/jpg" wire:model="photo">
                    @elseif(!$pdf)
                    <button type="button" class="btn btn-danger mr-2" wire:click="$set('photo', null)">Cancelar</button>
                    @endif
                    @if(is_null($pdf) && !$photo)
                    <label for="pdf" class="btn btn-primary mb-0 mr-2" alt="Subir pdf" data-toggle="tooltip" data-placement="bottom" title="Subir PDF"><b>+ </b><i class="far fa-file-pdf"></i></label>
                    <input type="file" name="" class="d-none" id="pdf" accept="application/pdf" wire:model="pdf">
                    @elseif(!$photo)
                    <button type="button" class="btn btn-danger mr-2" wire:click="$set('pdf', null)">Cancelar</button>
                    @endif
                </div>

            </div>
        </div>
    </div>
    @if(count(Auth::user()->seguidos)==0)
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">Aun no sigues ningun usuario</h5>
            <p class="card-text">Por el momento veras tus propios posts hasta que sigas mas usuarios</p>
        </div>
    </div>
    @endif

    <div wire:poll.10000ms>
        @foreach($postsfeed as $post)
        <div class="card card-widget">
            <div class="card-header">
                <div class="user-block">
                    @if($post->user->foto)
                    <img class="img-circle" src="{{asset('storage').'/'.$post->user->foto}}" alt="user image">
                    @else
                    <img class="img-circle" src="{{asset('img/profilepic placeholder.jpg')}}" alt="user image">
                    @endif
                    <span class="username"><a href="{{ url('usuario/'.$post->user->id) }}">{{$post->user->name}}</a></span>
                    <span class="description">Compartio - {{ $post->created_at->diffForHumans()}}</span>
                </div>
                @if($post->user->id==Auth::user()->id || Auth::user()->rol=='administrador')
                <a href="#" class="float-right btn-tool" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                    <button class="dropdown-item" onclick="confirm('??Quieres Borrar el Post?')|| event.stopImmediatePropagation()" wire:click="delete({{ $post->id }})">Eliminar</button>

                    {{--<a class="dropdown-item" href="#">Reportar</a>--}}
                </div>
                @endif
                <!-- /.user-block -->
                {{--<div class="card-tools">
                    <button type="button" class="btn btn-tool" title="Mark as read">
                        <i class="far fa-circle"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="collapse">
                        <i class="fas fa-minus"></i>
                    </button>
                    <button type="button" class="btn btn-tool" data-card-widget="remove">
                        <i class="fas fa-times"></i>
                    </button>
                </div>--}}
                <!-- /.card-tools -->
            </div>
            <!-- /.card-header -->
            <div class="card-body">
                <!-- post text -->
                <p>{{$post->body}}</p>

                @if(isset($post->foto))
                <!-- Attachment -->
                <div class="attachment-block clearfix">


                    <img class="img-fluid mx-auto d-block" src="{{ asset('storage').'/'.$post->foto}}" alt="">


                </div>
                <!-- /.attachment-block -->
                @endif

                @if(isset($post->pdf))
                <ul class="mailbox-attachments d-flex align-items-stretch clearfix">
                    <li>
                        <span class="mailbox-attachment-icon"><i class="far fa-file-pdf"></i></span>

                        <div class="mailbox-attachment-info">
                            <a href="{{ asset('storage').'/'.$post->pdf}}" target="_blank" class="mailbox-attachment-name"><i class="fas fa-paperclip"></i>Archivo PDF</a>
                            <span class="mailbox-attachment-size clearfix mt-1">
                                <span>{{round(File::size('storage/'.$post->pdf)/1024)}} KB</span>
                                <a href="{{ asset('storage').'/'.$post->pdf}}" target="_blank" class="btn btn-default btn-sm float-right"><i class="fas fa-cloud-download-alt"></i></a>
                            </span>
                        </div>
                    </li>
                </ul>
                @endif

                <!-- Social sharing buttons -->
                <button type="button" class="btn btn-default btn-sm" wire:click="hitLike({{ $post->id }})"><i class="@if(count($post->likes->where('user_id', Auth::user()->id))>0) fas fa-thumbs-up @else far fa-thumbs-up @endif"></i> Like</button>
                <span class="float-right text-muted">{{count($post->likes)}} likes - {{count($post->comments)}} Comentarios</span>
            </div>
            <!-- /.card-body -->
            <div class="card-footer card-comments">
                @foreach($post->comments as $comment)
                <div class="card-comment">
                    @if($comment->user->foto)
                    <img class="img-circle img-sm" src="{{asset('storage').'/'.$comment->user->foto}}" alt="User Image">
                    @else
                    <img class="img-circle img-sm" src="{{asset('img/profilepic placeholder.jpg')}}" alt="User Image">
                    @endif
                    <div class="comment-text">
                        <span class="username">
                            <a href="{{ url('usuario/'.$comment->user->id) }}">{{$comment->user->name}}</a>
                            @if($comment->user->id==Auth::user()->id || Auth::user()->rol=='administrador'|| $comment->post->user->id==Auth::user()->id)
                            <a href="#" class="float-right btn-tool" id="dropdownMenuButtonComment" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-ellipsis-v"></i></a>
                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButtonComment">

                                <button class="dropdown-item" onclick="confirm('??Quieres Borrar el Comentario?')|| event.stopImmediatePropagation()" wire:click="deleteComment({{ $comment->id }})">Eliminar Comentario</button>

                                {{--<a class="dropdown-item" href="#">Reportar</a>--}}
                            </div>
                            @endif
                            <span class="text-muted float-right">{{$comment->created_at->diffForHumans()}}</span>
                        </span><!-- /.username -->
                        {{$comment->content}}
                    </div>
                    <!-- /.comment-text -->
                </div>
                @endforeach
            </div>
            <!-- /.card-footer -->
            <div class="card-footer">
                @if(Auth::User()->foto)
                <img class="img-fluid img-circle img-sm" src="{{asset('storage').'/'.Auth::User()->foto}}" alt="User Image">
                @else
                <img class="img-fluid img-circle img-sm" src="{{asset('img/profilepic placeholder.jpg')}}" alt="User Image">
                @endif
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Presiona enter para comentar" wire:keydown.enter="addComment({{ $post->id }})" wire:model.lazy="newComment">
                </div>

            </div>
            <!-- /.card-footer -->
        </div>

        @endforeach
    </div>
</div>