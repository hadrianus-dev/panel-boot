<?php

namespace Domain\Comment\Jobs;

use Domain\Comment\Actions\UpdateCommentAction;
use Domain\Comment\Models\Comment;
use Domain\Comment\ValueObject\CommentValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateComment implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Comment $Comment,
        public CommentValueObject $object
    ){}

    public function handle(): void
    {
        UpdateCommentAction::handle(object: $this->object, Comment: $this->Comment);
    }
}
