<?php

namespace Domain\Service\Jobs;

use Domain\Service\Actions\UpdateServiceAction;
use Domain\Service\Models\Service;
use Domain\Service\ValueObject\ServiceValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateService implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Service $Service,
        public ServiceValueObject $object
    ){}

    public function handle(): void
    {
        UpdateServiceAction::handle(object: $this->object, Service: $this->Service);
    }
}
