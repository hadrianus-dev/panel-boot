<?php

declare(strict_types=1);

namespace Domain\Partner\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Partner\Actions\CreatePartnerAction;
use Domain\Partner\Aggragates\PartnerAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Partner\ValueObject\PartnerValueObject;

class CreatePartner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public PartnerValueObject $object
    ){}

    public function handle(): void
    {
        CreatePartnerAction::handle(object: $this->object);
    }
}
