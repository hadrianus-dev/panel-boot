<?php

namespace Domain\Shared\User\Jobs;

use Illuminate\Bus\Queueable;
use Domain\Shared\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Shared\User\Actions\UpdateUserAction;
use Domain\Shared\User\ValueObject\UserValueObject;

class UpdateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public User $user,
        public UserValueObject $object
    ){}

    public function handle(): void
    {
        UpdateUserAction::handle(object: $this->object, user: $this->user);
    }
}
