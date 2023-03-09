<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckHeader
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (isset($_SERVER['HTTP_APIKEY'])) {
            $apikey = $_SERVER['HTTP_APIKEY'];

            if ($apikey == 123) {
                return $next($request);
            } else {
                $data['status'] = false;
                $data['message'] = 'Enter Right Api key';
                return new JsonResponse($data, 401);
            }
        } else {
            $data['status'] = false;
            $data['message'] = 'Unauthorized Access';
            return new JsonResponse($data, 401);
        }
    }
}
