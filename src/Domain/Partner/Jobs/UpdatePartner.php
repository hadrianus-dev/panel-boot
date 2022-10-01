<?php

namespace Domain\Partner\Jobs;

use Domain\Partner\Actions\UpdatePartnerAction;
use Domain\Partner\Models\Partner;
use Domain\Partner\ValueObject\PartnerValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePartner implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Partner $Partner,
        public PartnerValueObject $object
    ){}

    public function handle(): void
    {
        UpdatePartnerAction::handle(object: $this->object, Partner: $this->Partner);
    }
}
