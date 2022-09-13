<?php

namespace Domain\Portfolio\Jobs;

use Domain\Portfolio\Actions\UpdatePortfolioAction;
use Domain\Portfolio\Models\Portfolio;
use Domain\Portfolio\ValueObject\PortfolioValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdatePortfolio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Portfolio $Portfolio,
        public PortfolioValueObject $object
    ){}

    public function handle(): void
    {
        UpdatePortfolioAction::handle(object: $this->object, Portfolio: $this->Portfolio);
    }
}
