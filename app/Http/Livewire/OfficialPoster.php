<?php

namespace App\Http\Livewire;

use Livewire\Component;
use Livewire\WithFileUploads;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;

class OfficialPoster extends Component
{

    //use WithPagination;
    use WithFileUploads;

    public $photo;

    public $pdf;

    public $posts;

    public $initialPosts;

    public $newPost;

    public $newComment;

    public $user;
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

        $this->newPost = null;
        $this->emit('officialPostAdded');
    }


    public function render()
    {
        return view('livewire.official-poster');
    }
}
