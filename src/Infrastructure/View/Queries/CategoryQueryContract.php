<?php

declare(strict_types=1);

namespace Infrastructure\View\Queries;

use Illuminate\Http\JsonResponse;

interface CategoryQueryContract
{
    public function handle(): JsonResponse;
}
