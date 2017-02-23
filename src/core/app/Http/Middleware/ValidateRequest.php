<?php

namespace App\Http\Middleware;

use Closure;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Exceptions\JWTException;

class ValidateRequest
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
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['success' => 0, 'error' => trans('validation_messages.token_validation.user_not_exist')]);
            }

        } catch (TokenExpiredException $e) {
            return response()->json(['success' => 0, 'error' => trans('validation_messages.token_validation.expired')]);

        } catch (TokenInvalidException $e) {

            return response()->json(['success' => 0, 'error' => trans('validation_messages.token_validation.invalid')]);

        } catch (JWTException $e) {

            return response()->json(['success' => 0, 'error' => trans('validation_messages.token_validation.not_exist')]);

        }

        $request->attributes->add(['user' => $user]);

        return $next($request);
    }
}
