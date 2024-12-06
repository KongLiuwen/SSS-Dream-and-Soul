<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next): Response
    {
        // 检查用户是否已登录，且角色为 admin
        if (auth()->check() && auth()->user()->role === 'admin') {
            return $next($request);
        }

        // 如果不是管理员，重定向到首页或返回 403 错误
        abort(403, 'Unauthorized action.');
    }
}

