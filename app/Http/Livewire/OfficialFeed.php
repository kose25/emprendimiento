<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Query\Builder;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class OfficialFeed extends Component
{
    public $limitPerPage = 3;
    public $newComment;

    protected $listeners = [
        'load-more' => 'loadMore',
        'postAdded' => 'render'
    ];
    public function addComment($currentPost)
    {
        $createdComment = Comment::create(['content' => $this->newComment, 'user_id' => Auth::user()->id, 'post_id' => $currentPost]);
        //$this->posts[$index]->comments->push($createdComment);
        $this->newComment = '';
    }

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 6;
    }
    public function render()
    {
        //$posts=Post::where('usuario',5)->get();
        $posts = Post::whereHas('user', function ($q) {
            $q->where('rol', 'administrador');
        })->orderByDesc('id')->paginate($this->limitPerPage);
        return view('livewire.official-feed', ['posts' => $posts]);
    }
}
