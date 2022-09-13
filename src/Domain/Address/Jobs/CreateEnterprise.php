<?php

declare(strict_types=1);

namespace Domain\Address\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Address\Actions\CreateAddressAction;
use Domain\Address\Aggragates\AddressAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Address\ValueObject\AddressValueObject;

class CreateAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public AddressValueObject $object
    ){}

    public function handle(): void
    {
        CreateAddressAction::handle(object: $this->object);
    }
}
