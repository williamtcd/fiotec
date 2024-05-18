<?php

    namespace App\Http\Middleware;

    use Closure;
    use JWTAuth;
    use Exception;
    use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;

    class JwtMiddleware
    {
        /** 
         * 
         * 
         * @param \Illuminate\Http\Request $request
         * @param \Closure
         * @return mixed
         */
        public function handle($request, Closure $next)
        {
            try{
                $user = JWTAuth::parseToken()->authenticate();
            } catch (Exception $e) {
                if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                    return response()->json(['message'=> 'token inválido']);
                } else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                    return response()->json(['message'=> 'token expirado']);
                } else {
                    return response()->json(['message'=> 'token de autorização não encontrado']);
                }
            }
            return $next($request);
        }
    }