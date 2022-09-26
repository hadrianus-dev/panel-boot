<?php

namespace Domain\Enterprise\Jobs;

use Domain\Enterprise\Actions\UpdateEnterpriseAction;
use Domain\Enterprise\Models\Enterprise;
use Domain\Enterprise\ValueObject\EnterpriseValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateEnterprise implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Enterprise $Enterprise,
        public EnterpriseValueObject $object
    ){}

    public function handle(): void
    {
        UpdateEnterpriseAction::handle(object: $this->object, Enterprise: $this->Enterprise);
    }
}
