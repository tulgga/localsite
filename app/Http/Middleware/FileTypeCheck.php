<?php

namespace App\Http\Middleware;

use Closure;
use Symfony\Component\HttpFoundation\Response;

class FileTypeCheck
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
        foreach (array_flatten($request->files->all()) as $file) {


            dd($file);

//            if ($size > $onemb) {
//                abort(Response::HTTP_UNPROCESSABLE_ENTITY);
//            }
        }

        return $next($request);
    }
}