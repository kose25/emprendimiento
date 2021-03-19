<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;

class Profilepost extends Component
{

    public $posts;

    public $initialPosts;

    public $newPost;

    public function mount()
    {

        $this->posts=Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();;
        //dd($posts);

        //$initialPosts = Post::where('usuario', Auth::user()->id)->orderByDesc('id')->get();
    }

    public function addPost()
    {

        $createdPost=Post::create(['body'=>$this->newPost, 'usuario'=> Auth::user()->id ]);

        $this->posts->prepend($createdPost);


        /* array_unshift(
            $this->posts,
            [
                'body' => $this->newPost,
                'created_at' => Carbon::now()->diffForHumans()
            ]
        ); */

        $this->newPost = 'Que estas pensando?';
    }



    public function render()
    {
        return view('livewire.profilepost');
    }
}
