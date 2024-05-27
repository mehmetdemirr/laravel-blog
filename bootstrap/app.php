<?php

use App\Http\Middleware\Language;
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
               // Global Middleware
            //    $middleware->append(Language::class);

               // Alternatif olarak başa eklemek için
               // $middleware->prepend(Language::class);
       
               // Belirli bir grup için eklemek için
               $middleware->group('admin', [Language::class,]);
       
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
