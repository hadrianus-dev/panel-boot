<?php

namespace Domain\Portfolio\Jobs;

use Domain\Portfolio\Models\Portfolio;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeletePortfolio implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Portfolio $Portfolio){}

    public function handle()
    {
        $this->Portfolio->delete();
    }
}
