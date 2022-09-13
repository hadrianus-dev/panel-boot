<?php

namespace Domain\Church\Jobs;

use Domain\Church\Actions\UpdateChurchAction;
use Domain\Church\Models\Church;
use Domain\Church\ValueObject\ChurchValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateChurch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Church $church,
        public ChurchValueObject $object
    ){}

    public function handle(): void
    {
        UpdateChurchAction::handle(object: $this->object, church: $this->church);
    }
}
