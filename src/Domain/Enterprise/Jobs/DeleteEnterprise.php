<?php

namespace Domain\Enterprise\Jobs;

use Domain\Enterprise\Models\Enterprise;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class DeleteEnterprise implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(public Enterprise $Enterprise){}

    public function handle()
    {
        $this->Enterprise->delete();
    }
}
