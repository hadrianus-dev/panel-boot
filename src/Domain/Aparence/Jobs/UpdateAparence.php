<?php

namespace Domain\Aparence\Jobs;

use Domain\Aparence\Actions\UpdateAparenceAction;
use Domain\Aparence\Models\Aparence;
use Domain\Aparence\ValueObject\AparenceValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAparence implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Aparence $Aparence,
        public AparenceValueObject $object
    ){}

    public function handle(): void
    {
        UpdateAparenceAction::handle(object: $this->object, Aparence: $this->Aparence);
    }
}
