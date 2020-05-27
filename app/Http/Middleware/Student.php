<?php
/**
 * Created by PhpStorm.
 * User: Abd
 * Date: 5/14/2020
 * Time: 10:52 PM
 */

namespace App\Http\Middleware;
use Closure;
use App\User;
use Illuminate\Support\Facades\Auth;

class Student
{

    public function handle($request, Closure $next, $guard = null)
    {
        if (!Auth::user()->isStudent()) {
            return redirect()->back();
        }

        return $next($request);
    }

}