<div wire:poll.10000ms>

    @if(isset($user) && $user->id==Auth::user()->id)
    <div class="my-2">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="280" wire:model.lazy="newPost">Que estas pensando?</textarea>
        <div class="d-flex flex-row-reverse my-2">
            <button type="button" class="btn btn-primary" wire:click="addPost">Postear</button>
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

        <p>
            <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> -->
            <button type="button" class="btn btn-link" wire:click="hitLike({{ $post->id }})" >({{count($post->likes)}})<i class="@if(count($post->likes->where('user_id', Auth::user()->id))>0) fas fa-thumbs-up @else far fa-thumbs-up @endif"></i>Like</button>
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