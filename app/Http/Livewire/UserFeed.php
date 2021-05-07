<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use App\Models\Comment;
use App\Models\Like;
use Intervention\Image\Facades\Image;

class UserFeed extends Component
{
    use WithFileUploads;

    public $photo;

    public $pdf;

    public $posts;

    public $initialPosts;

    public $newPost = '';

    public $user;
    public $limitPerPage = 3;
    public $newComment;
    protected $listeners = [
        'load-more' => 'loadMore',
        'postAdded' => 'render'
    ];

    public function loadMore()
    {
        $this->limitPerPage = $this->limitPerPage + 3;
    }

    public function deleteComment($currentComment){
        Comment::find($currentComment)->delete();
    }

    public function delete($currentPost){
        Post::find($currentPost)->delete();
    }

    public function addComment($currentPost)
    {
        $createdComment = Comment::create(['content' => $this->newComment, 'user_id' => Auth::user()->id, 'post_id' => $currentPost]);
        //$this->posts[$index]->comments->push($createdComment);
        $this->newComment = '';
    }

    public function hitLike($currentPost)
    {
        if (Like::where('post_id', $currentPost)->where('user_id', Auth::user()->id)->count() > 0) {
            Like::where('post_id', $currentPost)->where('user_id', Auth::user()->id)->delete();
        } else {
            Like::create(['user_id' => Auth::user()->id, 'post_id' => $currentPost]);
        }
    }
    public function resizePhoto($photopath)
    {
        $img = Image::make('storage/' . $photopath);
        if ($img->height() > 1080 && $img->width() > 1080) {
            if ($img->height() > $img->width()) {
                $img->resize(null, 1080, function ($constraint) {
                    $constraint->aspectRatio();
                });
            } else {
                $img->resize(1080, null, function ($constraint) {
                    $constraint->aspectRatio();
                });
            }
        }
        if ($img->width() > 1080 && $img->height() <= 1080) {
            $img->resize(1080, null, function ($constraint) {
                $constraint->aspectRatio();
            });
        } else {
            $img->resize(null, 1080, function ($constraint) {
                $constraint->aspectRatio();
            });
        }
        $img->save('storage/' . $photopath, 80, 'jpg');
    }

    public function addPost()
    {

        //$createdPost = Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id]);
        if ($this->newPost && $this->newPost != 'Que estas pensando?') {
            if (is_null($this->photo) && is_null($this->pdf)) {
                $createdPost = Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id]);
            } elseif ($this->photo) {
                //$fotico = $this->photo->store('uploads', 'public');                
                $fotico = $this->photo->store('uploads', 'public');
                $this->resizePhoto($fotico);
                Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id, 'foto' => $fotico]);
                $this->photo = null;
            } else {
                $pdfcito = $this->pdf->store('uploads', 'public');
                Post::create(['body' => $this->newPost, 'usuario' => Auth::user()->id, 'pdf' => $pdfcito]);
                $this->pdf = null;
            }
            $this->emit('postAdded');
        }

        $this->newPost = '';
        $this->emit('officialPostAdded');
    }

    public function render()
    {
        $postsfeed = Post::whereIn('usuario', function ($query) {
            $query->select('follows')
                ->from('follows')
                ->where('user_id', Auth::user()->id);
        })->orWhere('usuario', Auth::user()->id)->orderByDesc('id')->paginate($this->limitPerPage);
        return view('livewire.user-feed', ['postsfeed' => $postsfeed]);
    }
}
