<?php

use Illuminate\Auth\Access\AuthorizationException;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        api: __DIR__.'/../routes/api.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(
            prepend: [
                \App\Http\Middleware\ApiForceJsonResponse::class
            ]
        );
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->shouldRenderJsonWhen(function(Request $request, Throwable $err) use ($exceptions) {
            if ($request->is('api/*')) {

                if ($exceptions instanceof AuthorizationException) {
                    return response()->json([
                        'success' => false,
                        'data' => null,
                        'message' => 'Unauthenticated'
                    ], 401);
                }

                return response()->json([
                    'success' => false,
                    'data' => null,
                    'message' => 'No accept header!'
                ], 401);
            }

            return $request->expectsJson();
        });
    })->create();
