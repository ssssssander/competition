<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Storage;

class CheckCompetitionStatus
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
        $currentTermNr = (int)Storage::get(config('globals.current_term_nr_filename'));

        if($currentTermNr == 0) {
            return redirect()->back()->with(
                ['message' => 'De wedstrijd is voorbij!', 'message-type' => 'warning']
            );
        }

        return $next($request);
    }
}
