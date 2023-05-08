<?php

namespace Modules\User\src\Http\Middlewares;

use Closure;

class DemoMiddleware {
    public function handle($request, Closure $next) {
        echo 'Demo middleware';
        return $next($request);
    }
}