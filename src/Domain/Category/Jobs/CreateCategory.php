<?php

declare(strict_types=1);

namespace Domain\Category\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Category\Actions\CreateCategoryAction;
use Domain\Category\Aggragates\CategoryAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Category\ValueObject\CategoryValueObject;

class CreateCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public CategoryValueObject $object
    ){}

    public function handle(): void
    {
        CreateCategoryAction::handle(object: $this->object);
    }
}
