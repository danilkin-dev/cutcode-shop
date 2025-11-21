<?php

namespace App\Providers;

use App\Events\AfterSessionRegenerated;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    public function register(): void
    {
        //
    }

    public function boot(): void
    {
        Event::listen(AfterSessionRegenerated::class, function (AfterSessionRegenerated $event) {
            cart()->updateStorageId(
                $event->old,
                $event->current
            );
        });
    }
}
