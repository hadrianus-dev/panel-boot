<?php

declare(strict_types=1);

namespace Domain\Service\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Service\Actions\CreateServiceAction;
use Domain\Service\Aggragates\ServiceAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Service\ValueObject\ServiceValueObject;

class CreateService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public ServiceValueObject $object
    ){}

    public function handle(): void
    {
        CreateServiceAction::handle(object: $this->object);
    }
}
