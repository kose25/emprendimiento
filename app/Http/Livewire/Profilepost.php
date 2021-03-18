<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;

class Profilepost extends Component
{

    public $posts = [
        [
            'body' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum id massa quis sem faucibus tempus. Aliquam sagittis pulvinar sem, in ultricies velit imperdiet sit amet. Suspendisse sed augue quis elit aliquam finibus a non nisi. Praesent auctor vitae dui ac sodales. Nam nec leo orci. Mauris at leo ut sapien pretium vehicula.  ',
            'created_at' => 'hace 3 minutos'
        ]
    ];

    public $newPost;

    public function addPost()
    {
        array_unshift(
            $this->posts,
            [
                'body' => $this->newPost,
                'created_at' => Carbon::now()->diffForHumans()
            ]
        );

        $this->newPost='Que estas pensando?';
    }



    public function render()
    {
        return view('livewire.profilepost');
    }
}
