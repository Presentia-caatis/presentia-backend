<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Validation\ValidationException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        api: __DIR__ . '/../routes/api.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->api(prepend: [
            \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
        ]);

        $middleware->alias([
            'verified' => \App\Http\Middleware\EnsureEmailIsVerified::class,
        ]);

        $middleware->validateCsrfTokens(except: [
            '*',
        ]);

        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        // Handle ValidationException
        $exceptions->renderable(function (ValidationException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Validation failed',
                'errors' => $e->errors(),
            ], 422); 
        });

        $exceptions->renderable(function (NotFoundHttpException $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Resource not found',
                'error' => $e->getMessage(),
            ], 404);  // 404 Not Found status
        });

        $exceptions->renderable(function (Throwable $e, $request) {
            return response()->json([
                'status' => 'error',
                'message' => 'Something went wrong',
                'error' => $e->getMessage(),
            ], 500);  // 500 Internal Server Error
        });
    })->create();
