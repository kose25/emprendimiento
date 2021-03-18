<div>
    <div class="my-2">
        <textarea class="form-control" id="exampleFormControlTextarea1" rows="3" maxlength="280" wire:model="newPost">Que estas pensando?</textarea>
        <div class="d-flex flex-row-reverse my-2">
            <button type="button" class="btn btn-primary" wire:click="addPost">Postear</button>
        </div>
    </div>
    @foreach($posts as $post)
    <!-- Post -->
    <div class="post">
        <div class="user-block">
            <img class="img-circle img-bordered-sm" src="https://picsum.photos/300/300" alt="user image">
            <span class="username">
                <a href="#">{{Auth::user()->name}}</a>
                <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
            </span>
            <span class="description">{{ $post['created_at']}}</span>
        </div>
        <!-- /.user-block -->
        <p>
            {{$post['body']}}
        </p>

        <p>
            <!-- <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a> -->
            <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
            <span class="float-right">
                <a href="#" class="link-black text-sm">
                    <i class="far fa-comments mr-1"></i> Comments (5)
                </a>
            </span>
        </p>

        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
    </div>
    <!-- /.post -->
    <hr>
    @endforeach

</div>