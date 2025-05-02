<?php

use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        //dd($middleware->getMiddlewareGroups());
        $middleware->redirectGuestsTo(function (Request $request) {
            //dd($request->route()->action['middleware']);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // Customize redirection logic based on the request
            //return $request->is('admin/*') ? route('admin.login') : route('login');
            return in_array('auth:admin', $request->route()->action['middleware']) ? route('admin.login') : route('login');
        });
        $middleware->redirectUsersTo(function (Request $request) {
            //dd($request->route()->action['middleware']);
            if ($request->expectsJson()) {
                return response()->json(['message' => 'Unauthenticated.'], 401);
            }

            // Customize redirection logic based on the request
            //return $request->is('admin/*') ? route('admin.login') : route('login');
            return in_array('guest:admin', $request->route()->action['middleware']) ? route('admin.dashboard') : route('dashboard');
        });
    })
    ->withExceptions(function (Exceptions $exceptions) {
       //
    })->create();
