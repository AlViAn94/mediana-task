<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;
use Symfony\Component\HttpKernel\Exception\UnauthorizedHttpException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;

class IsAuthenticated extends BaseMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param Request $request
     * @param Closure $next
     * @return JsonResponse|mixed
     * @throws JWTException
     */
    public function handle(Request $request, Closure $next)
    {
        if ($this->auth->parser()->setRequest($request)->hasToken()) {
            try {
                $this->auth->parseToken()->authenticate();
            } catch (TokenExpiredException|UnauthorizedHttpException|TokenInvalidException $e) {
                return response()->json(['Error' => $e->getMessage()], 401);
            }
        }else{
            return response()->json(['Error' => 'Token not provided.'], 401);
        }
        return $next($request);
    }
}
