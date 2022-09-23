<?php

declare(strict_types=1);

namespace Domain\Shared\Helpers\TypeFile;

use App\Http\Requests\Shared\ImageSharedRequest;

class ImageValidateType
{
    public function __construct(public ImageSharedRequest $image){}
}
