<?php

use App\Http\Middleware\HandleInertiaRequests;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Symfony\Component\HttpFoundation\Response;
use Illuminate\Http\Request;
use Inertia\Inertia;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->web(append: [
            HandleInertiaRequests::class,
        ]);
        $middleware->alias([
            'auth' => \App\Http\Middleware\AuthMiddleware::class
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Lalu, di closure Anda:
        $exceptions->respond(function (Response $response, \Throwable $exception, Request $request) {
            return Inertia::render('Error/Error',[
                'message'=>$exception->getMessage(),
                'statusCode'=>$response->getStatusCode()
            ]);
        });
    })->create();
