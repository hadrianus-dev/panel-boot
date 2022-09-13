<?php

declare(strict_types=1);

namespace Domain\Church\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Church\Actions\CreateChurchAction;
use Domain\Church\Aggragates\ChurchAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Church\ValueObject\ChurchValueObject;

class CreateChurch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public ChurchValueObject $object
    ){}

    public function handle(): void
    {
        ChurchAggragate::retrieve(
            uuid: Str::uuid()->toString()
        )->createChurch(
            object: $this->object
        )->persist();
        #CreateChurchAction::handle(object: $this->object);
    }
}
