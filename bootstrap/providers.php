<?php

use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

return [
    App\Providers\AppServiceProvider::class,
];
class AppServiceProvider extends ServiceProvider
{
    public function boot(): void
    {
        Paginator::useTailwind();
    }
}
