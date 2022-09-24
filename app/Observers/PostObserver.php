<?php

namespace App\Observers;

use Domain\Post\Models\Post;
use Domain\Shared\Helpers\Upload\UploadImage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostObserver
{
    public $afterCommit = true;
   
    public function created(Post $post): void
    {
        /* if($post->where('user_id', Auth::user()->id)):
            $cover = session('cover');
            $post->save(['cover' => $cover]);
        endif; */
    }

    /**
     * Handle the Post "updated" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function updated(Post $post)
    {
        //
    }

    /**
     * Handle the Post "deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function deleted(Post $post)
    {
        //
    }

    /**
     * Handle the Post "restored" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function restored(Post $post)
    {
        //
    }

    /**
     * Handle the Post "force deleted" event.
     *
     * @param  \App\Models\Post  $post
     * @return void
     */
    public function forceDeleted(Post $post)
    {
        //
    }
}
