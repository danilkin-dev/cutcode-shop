<?php

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\ProductController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class ProductRegistrar implements RouteRegistrar
{
    public function map(Registrar $router): void
    {
        Route::middleware(['throttle:web', 'web'])->group(function () {
            Route::get('/product/{product:slug}', ProductController::class)
                ->name('product');
        });
    }
}
