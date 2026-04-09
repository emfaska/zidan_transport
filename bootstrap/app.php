<?php

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
    $middleware->validateCsrfTokens(except: [
        'midtrans/callback',
    ]);

    $middleware->alias([
        'role' => \App\Http\Middleware\RoleMiddleware::class,
    ]);

    $middleware->redirectUsersTo(function () {
        // Jika user belum login, biarkan default (akan ditangani auth middleware)
        if (!\Illuminate\Support\Facades\Auth::check()) {
            return '/login';
        }

        // Redirect sesuai role
        return match (\Illuminate\Support\Facades\Auth::user()->role) {
            'admin' => '/admin/dashboard',
            'pengemudi' => '/driver/dashboard',
            default => '/home',
        };
    });
    })
    ->withExceptions(function (Exceptions $exceptions): void {
        //
    })->create();
