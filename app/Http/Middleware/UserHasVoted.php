<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class UserHasVoted
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $vote = $request->route('vote');

        if (auth()->user()->results->contains('vote_id', $vote->id)) return back()->with('answerCreateFailure', 'Vous avez déjà voté');

        return $next($request);
    }
}
