<?php

namespace Domain\Address\Jobs;

use Domain\Address\Actions\UpdateAddressAction;
use Domain\Address\Models\Address;
use Domain\Address\ValueObject\AddressValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAddress implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Address $Address,
        public AddressValueObject $object
    ){}

    public function handle(): void
    {
        UpdateAddressAction::handle(object: $this->object, Address: $this->Address);
    }
}
