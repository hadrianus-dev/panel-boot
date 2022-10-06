<?php

declare(strict_types=1);

namespace Domain\FAQ\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\FAQ\Actions\CreateFAQAction;
use Domain\FAQ\Aggragates\FAQAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\FAQ\ValueObject\FAQValueObject;

class CreateFAQ implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public FAQValueObject $object
    ){}

    public function handle(): void
    {
        CreateFAQAction::handle(object: $this->object);
    }
}
