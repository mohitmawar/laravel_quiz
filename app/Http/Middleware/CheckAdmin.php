<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Admin;

class CheckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $aUser = Auth::guard('admin')->user();
        if(!in_array($aUser->role , array(Admin::ADMIN_ROLE,Admin::SUB_ADMIN_ROLE))){
            return redirect()->route('adminGetLogout')->with('error', 'You are not Authentic person');
        }else{
            $adminLogin = $staffLogin = $hostLogin = false;
            if (in_array($aUser->role, array(Admin::ADMIN_ROLE)))
                $adminLogin = true;
            if (in_array($aUser->role, array(Admin::SUB_ADMIN_ROLE)))
                $staffLogin = true;
            view()->share('adminLogin', $adminLogin);
            view()->share('staffLogin', $staffLogin);
        }
        return $next($request);
    }
}
