<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     */
    protected $routeMiddleware = [
        'admin' => \App\Http\Middleware\IsAdmin::class,
        'user' => \App\Http\Middleware\IsUser::class,
    ];


}
