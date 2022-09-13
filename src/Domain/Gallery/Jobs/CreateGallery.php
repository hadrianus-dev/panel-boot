<?php

declare(strict_types=1);

namespace Domain\Gallery\Jobs;

use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Domain\Gallery\Actions\CreateGalleryAction;
use Domain\Gallery\Aggragates\GalleryAggragate;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Domain\Gallery\ValueObject\GalleryValueObject;

class CreateGallery implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    
    public function __construct(
        public GalleryValueObject $object
    ){}

    public function handle(): void
    {
        CreateGalleryAction::handle(object: $this->object);
    }
}
