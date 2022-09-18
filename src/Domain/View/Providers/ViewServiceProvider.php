<?php

declare(strict_types=1);

namespace Domain\View\Providers;

use Domain\View\Queries\CategoryQuery;
use Illuminate\Support\ServiceProvider;
use Infrastructure\View\Queries\CategoryQueryContract;

class ViewServiceProvider extends ServiceProvider
{
    public array $blindings = [
        CategoryQueryContract::class => CategoryQuery::class,
    ];
}
