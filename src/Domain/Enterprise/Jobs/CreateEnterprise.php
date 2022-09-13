<?php

declare(strict_types=1);

namespace Domain\Enterprise\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Enterprise\Actions\CreateEnterpriseAction;
use Domain\Enterprise\Aggragates\EnterpriseAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Enterprise\ValueObject\EnterpriseValueObject;

class CreateEnterprise implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public EnterpriseValueObject $object
    ){}

    public function handle(): void
    {
        CreateEnterpriseAction::handle(object: $this->object);
    }
}
