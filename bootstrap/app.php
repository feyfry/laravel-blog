<?php

use Illuminate\Foundation\Application;
use App\Http\Middleware\OwnerMiddleware;
use App\Http\Middleware\ShareFooterDataMiddleware;
use App\Http\Middleware\WriterMiddleware;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'writer' => WriterMiddleware::class,
            'owner'  => OwnerMiddleware::class,
        ]);
        $middleware->web(ShareFooterDataMiddleware::class);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
