<?php

namespace Domain\Gallery\Jobs;

use Domain\Gallery\Actions\UpdateGalleryAction;
use Domain\Gallery\Models\Gallery;
use Domain\Gallery\ValueObject\GalleryValueObject;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateGallery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        public Gallery $Gallery,
        public GalleryValueObject $object
    ){}

    public function handle(): void
    {
        UpdateGalleryAction::handle(object: $this->object, Gallery: $this->Gallery);
    }
}
