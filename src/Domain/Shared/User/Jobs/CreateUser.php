<?php

declare(strict_types=1);

namespace Domain\Shared\User\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;

use Domain\Shared\User\Actions\CreateUserAction;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Shared\User\Aggragates\UserAggragate;
use Domain\Shared\User\ValueObject\UserValueObject;

class CreateUser implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public UserValueObject $object
    ){}

    public function handle(): void
    {
        UserAggragate::retrieve(
            uuid: Str::uuid()->toString()
        )->createUser(
            object: $this->object
        )->persist(); 
        #CreateUserAction::handle(object: $this->object);
    }
}
