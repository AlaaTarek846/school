<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStudentProfileCompleted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (auth()->guard('student')->check()) {
            $student = auth()->guard('student')->user();
            
            if (!$student->is_completed && !$request->routeIs('student.complete_profile') && !$request->routeIs('student.logout') && !$request->routeIs('student.complete_profile.post')) {
                return redirect()->route('student.complete_profile');
            }
        }

        return $next($request);
    }
}
