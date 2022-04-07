<?php

namespace App\Http\Middleware;

use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StatusManager
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if ($user) {
            if ($user->active) {
                if ($user->findRole('alumno')) {
                    $student = $user->student;
                    if ($student->banned) {
                        $now = Carbon::now()->format('Y-m-d H:i:s');
                        $ban = Carbon::createFromFormat('Y-m-d H:i:s',$student->banned_time);
                        if (!$ban->lte($now)) {
                            Auth::guard('web')->logout();
                            return redirect()->route('welcome')->with(['message'=>"El Estudiante Esta Expulsado hasta: {$student->banned_time}"]);
                        } else {
                            $student->update(['banned'=>false,'banned_time'=>NULL]);
                            return $next($request);
                        }
                    } else {
                        return $next($request);
                    }
                } else {
                    return $next($request);
                }
            } else {
                Auth::guard('web')->logout();
                return redirect()->route('welcome')->with(['message'=>'Usuario Desactivado']);
            }
        } else {
            return $next($request);
        }
    }
}
