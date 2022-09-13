<?php

namespace Domain\Post\Jobs;

use Domain\Post\Actions\UpdatePostAction;
use Domain\Post\Models\Post;
use Domain\Post\ValueObject\PostValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Post $Post,
        public PostValueObject $object
    ){}

    public function handle(): void
    {
        UpdatePostAction::handle(object: $this->object, Post: $this->Post);
    }
}
