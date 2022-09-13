<?php

declare(strict_types=1);

namespace Domain\Portfolio\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Portfolio\Actions\CreatePortfolioAction;
use Domain\Portfolio\Aggragates\PortfolioAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Portfolio\ValueObject\PortfolioValueObject;

class CreatePortfolio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public PortfolioValueObject $object
    ){}

    public function handle(): void
    {
        CreatePortfolioAction::handle(object: $this->object);
    }
}
