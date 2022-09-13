<?php

declare(strict_types=1);

namespace Domain\Post\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Post\Actions\CreatePostAction;
use Domain\Post\Aggragates\PostAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Post\ValueObject\PostValueObject;

class CreatePost implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public PostValueObject $object
    ){}

    public function handle(): void
    {
        CreatePostAction::handle(object: $this->object);
    }
}
