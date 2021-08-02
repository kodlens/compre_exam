<?php

namespace App\Http\Middleware;

use App\Models\AcadYear;
use App\Models\TakingTest;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\Models\TestSchedule;

use Carbon\Carbon;
use Auth;


class AllowExam
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
        //$nDateTime = Carbon::now()->toDateTimeString();
        $userid = Auth::user()->user_id;
        $acadyear = AcadYear::where('active', 1)->first();

        if(Auth::check()){

            

            return $next($request)
                ->header('Cache-Control','nocache, no-store, max-age=0, must-revalidate')
                ->header('Pragma','no-cache');
        }else{
            return redirect('/');
        }


    }
}
