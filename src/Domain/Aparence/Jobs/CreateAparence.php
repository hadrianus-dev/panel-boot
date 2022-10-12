<?php

declare(strict_types=1);

namespace Domain\Aparence\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Aparence\Actions\CreateAparenceAction;
use Domain\Aparence\Aggragates\AparenceAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Aparence\ValueObject\AparenceValueObject;

class CreateAparence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public AparenceValueObject $object
    ){}

    public function handle(): void
    {
        CreateAparenceAction::handle(object: $this->object);
    }
}
