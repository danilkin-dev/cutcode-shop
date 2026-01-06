<?php

declare(strict_types=1);

namespace App\Routing;

use App\Contracts\RouteRegistrar;
use App\Http\Controllers\OrderController;
use Illuminate\Contracts\Routing\Registrar;
use Illuminate\Support\Facades\Route;

final class OrderRegistrar implements RouteRegistrar
{
    public function map(Registrar $registrar): void
    {
        Route::middleware(['throttle:web', 'web'])->group(function () {
            Route::controller(OrderController::class)
                ->prefix('order')
                ->group(function () {
                    Route::get('/', 'index')->name('order');
                    Route::post('/create', 'handle')->name('order.handle');
                });
        });
    }
}
