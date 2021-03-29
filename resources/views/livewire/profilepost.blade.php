<div wire:poll.10000ms>

    @if(isset($user) && $user->id==Auth::user()->id)
    <div class="my-2">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="280" wire:model.lazy="newPost">Que estas pensando?</textarea>
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
    @endif

    @foreach($posts as $post)
    <!-- Post -->
    <div class="post">
        <div class="user-block">
            <img class="img-circle img-bordered-sm" src="https://picsum.photos/300/300" alt="user image">
            <span class="username">
                <a href="#">{{$post->user->name}}</a>
                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
            </span>
            <span class="description">{{ $post->created_at->diffForHumans()}}</span>
        </div>
        <!-- /.user-block -->
        <p>
            {{$post['body']}}
        </p>
        @if(isset($post->foto))

        <img class="img-fluid mx-auto d-block" src="{{ asset('storage').'/'.$post->foto}}" alt="">

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

        <p>
            <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> -->
            <button type="button" class="btn btn-link" wire:click="hitLike({{ $post->id }})">({{count($post->likes)}})<i class="@if(count($post->likes->where('user_id', Auth::user()->id))>0) fas fa-thumbs-up @else far fa-thumbs-up @endif"></i>Like</button>
            <!-- <a href="#" class="link-black text-sm"><i class=""></i> Like</a> -->
            <span class="float-right">
                <a href="#" class="link-black text-sm">
                    <i class="far fa-comments mr-1"></i> Comments ({{count($post->comments)}})
                </a>
            </span>
        </p>

        <div class="card-footer card-comments ">
            @foreach($post->comments as $comment)
            <div class="card-comment">
                <!-- User image -->
                <img class="img-circle img-sm" src="https://picsum.photos/128/128" alt="User Image">

                <div class="comment-text">
                    <span class="username">
                        {{$comment->user->name}}
                        <span class="text-muted float-right">{{$comment->created_at->diffForHumans()}}</span>
                    </span><!-- /.username -->
                    {{$comment->content}}
                </div>
                <!-- /.comment-text -->

            </div>
            @endforeach
        </div>
        <div class="card-footer">
            <div>
                <img class="img-fluid img-circle img-sm" src="https://picsum.photos/128/128" alt="Alt Text">
                <!-- .img-push is used to add margin to elements next to floating images -->
                <div class="img-push">
                    <input type="text" class="form-control form-control-sm" placeholder="Press enter to post comment" wire:keydown.enter="addComment({{ $post->id }}, {{ $loop->index }})" wire:model.lazy="newComment">
                </div>
            </div>
        </div>

        <!-- <input class="form-control form-control-sm" type="text" placeholder="Type a comment"> -->
    </div>
    <!-- /.post -->
    <hr>
    @endforeach

</div>