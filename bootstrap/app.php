<?php

use App\Http\Middleware\SeoMiddleware;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        using: function () {
            (new RouteServiceProvider(app()))->boot();
        },
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware): void {
        $middleware->alias([
            'seo' => SeoMiddleware::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        $exceptions->render(function (DomainException $e) {
            flash()->alert($e->getMessage());

            return session()->previousUri()
                ? redirect()->back()
                : redirect()->route('home');
        });
    })->create();
