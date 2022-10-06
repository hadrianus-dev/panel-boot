<?php

namespace Domain\FAQ\Jobs;

use Domain\FAQ\Actions\UpdateFAQAction;
use Domain\FAQ\Models\FAQ;
use Domain\FAQ\ValueObject\FAQValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateFAQ implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public FAQ $FAQ,
        public FAQValueObject $object
    ){}

    public function handle(): void
    {
        UpdateFAQAction::handle(object: $this->object, FAQ: $this->FAQ);
    }
}
