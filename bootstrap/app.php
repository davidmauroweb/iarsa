<?php
use App\Http\Middleware\{AdminMiddleware,central,mantenimiento,obra};
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware -> alias ([
            'adm' => AdminMiddleware::class,
            'cnt' => central::class,
            'mnt' => mantenimiento::class,
            'obr' => obra::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
