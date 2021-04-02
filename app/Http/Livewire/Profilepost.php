<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Like;
//use Livewire\WithPagination;
use Livewire\WithFileUploads;

class Profilepost extends Component
{

    //use WithPagination;
    use WithFileUploads;

    public $photo;

    public $pdf;

    public $posts;

    public $initialPosts;

    public $newPost='Que estas pensando?';

    public $newComment;

    public $user;

    //public $currentPost;

    //public $likeicon = 'far fa-thumbs-up mr-1';

    public function mount()
    {

        //$this->posts = Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();
        //dd($posts);

        //$initialPosts = Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();
    }

    public function addPost()
    {

        //$createdPost = Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id]);
        if ($this->newPost && $this->newPost!='Que estas pensando?') {
            if (is_null($this->photo) && is_null($this->pdf)) {
                $createdPost = Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id]);
            } elseif ($this->photo) {
                $fotico = $this->photo->store('uploads', 'public');
                Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id, 'foto' => $fotico]);
                $this->photo = null;
            } else {
                $pdfcito = $this->pdf->store('uploads', 'public');
                Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id, 'pdf' => $pdfcito]);
                $this->pdf = null;
            }
            $this->emit('postAdded');
        }



        //$this->posts->prepend($createdPost);


        /* array_unshift(
            $this->posts,
            [
                'body' => $this->newPost,
                'created_at' => Carbon::now()->diffForHumans()
            ]
        ); */

        $this->newPost = 'Que estas pensando?';
    }

    public function addComment($currentPost, $index)
    {
        $createdComment = Comment::create(['content' => $this->newComment, 'user_id' => Auth::user()->id, 'post_id' => $currentPost]);
        //$this->posts[$index]->comments->push($createdComment);
        $this->newComment = '';
    }

    public function delete($currentPost)
    {
        Post::find($currentPost)->delete();
    }

    public function hitLike($currentPost)
    {
        if (Like::where('post_id', $currentPost)->where('user_id', Auth::user()->id)->count() > 0) {
            Like::where('post_id', $currentPost)->where('user_id', Auth::user()->id)->delete();
        } else {
            Like::create(['user_id' => Auth::user()->id, 'post_id' => $currentPost]);
        }
    }



    public function render()
    {
        if (is_null($this->user)) {
            $this->posts = Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();
        } else {
            $this->posts = Post::where('usuario', $this->user->id)->orderByDesc('id')->get();
        }


        //$this->posts = Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();
        return view('livewire.profilepost');
    }
}
