<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\MethodNotAllowedHttpException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
//        web: __DIR__.'/../routes/web.php',
//        commands: __DIR__.'/../routes/console.php',
//        health: '/up',
        then: function () {
            Route::prefix('api')
                ->name('api.')
                ->group(base_path('routes/api/api.php'));
        },
    )
    ->withMiddleware(function (Middleware $middleware) {
        //
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->renderable(function (Exception $e, Request $request) {
            if (!$request->is('api/*')) {
                return null;
            }

            Log::error('API Error: ' . $e->getMessage(), ['exception' => $e]);

            $status = match (true) {
                $e instanceof NotFoundHttpException, $e instanceof MethodNotAllowedHttpException => $e->getStatusCode(),
                default => Response::HTTP_INTERNAL_SERVER_ERROR,
            };

            $message = $e->getMessage();

            return response()->json([
                'status' => $status,
                'message' => $message,
            ], $status);
        });
    })->create();
