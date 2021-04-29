<div wire:poll.10000ms>
    @foreach($posts as $post)
    <div class="card card-widget">
        <div class="card-header">
            <div class="user-block">
                <img class="img-circle" src="https://picsum.photos/128" alt="User Image">
                @if($post->user->rol=='administrador')
                <span class="username"><a href="#">Red Regional de Emprendimiento</a></span>
                @else
                <span class="username"><a href="#">{{$post->user->name}}</a></span>
                @endif
                <span class="description">Compartio - {{ $post->created_at->diffForHumans()}}</span>
            </div>
            <!-- /.user-block -->
            <div class="card-tools">
                <button type="button" class="btn btn-tool" title="Mark as read">
                    <i class="far fa-circle"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="collapse">
                    <i class="fas fa-minus"></i>
                </button>
                <button type="button" class="btn btn-tool" data-card-widget="remove">
                    <i class="fas fa-times"></i>
                </button>
            </div>
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
                <!-- User image -->
                @if($comment->user->foto && $comment->user->rol!='administrador')
                <img class="img-circle img-sm" src="{{asset('storage').'/'.$comment->user->foto}}" alt="User Image">                
                @else
                <img class="img-circle img-sm" src="{{asset('img/profilepic placeholder.jpg')}}" alt="User Image">
                @endif

                <div class="comment-text">
                    <span class="username">
                        @if($comment->user->rol=='administrador')
                        Regional de Emprendimiento
                        @else
                        <a href="{{ url('usuario/'.$comment->user->id) }}">{{$comment->user->name}}</a>
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