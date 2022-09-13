<?php

namespace Domain\Category\Jobs;

use Domain\Category\Actions\UpdateCategoryAction;
use Domain\Category\Models\Category;
use Domain\Category\ValueObject\CategoryValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateCategory implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Category $Category,
        public CategoryValueObject $object
    ){}

    public function handle(): void
    {
        UpdateCategoryAction::handle(object: $this->object, Category: $this->Category);
    }
}
