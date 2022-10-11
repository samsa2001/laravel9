<?php

namespace App\View\Components\web\post;

use App\Models\Post;
use Illuminate\View\Component;

class show extends Component
{
    public $post;
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct(Post $post)
    {
        $this->post = $post;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.web.post.show');
    }

    public function getTitle() {
        return $this -> post -> title;
    }
}
