<?php

declare(strict_types=1);

namespace Domain\Comment\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Comment\Actions\CreateCommentAction;
use Domain\Comment\Aggragates\CommentAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Comment\ValueObject\CommentValueObject;

class CreateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public CommentValueObject $object
    ){}

    public function handle(): void
    {
        CreateCommentAction::handle(object: $this->object);
    }
}
