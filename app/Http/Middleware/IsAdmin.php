<?php
    namespace App\Http\Middleware;
    use Closure;
    use Auth;


    class IsAdmin
    {
        public function handle($request, Closure $next,$guard = 'admin')
        {
            //Защита от перехода на страницу админ панели
            if (!Auth::guard($guard)->check()) {
                return redirect('/admin/login');
            }
            return $next($request);
        }
    }
