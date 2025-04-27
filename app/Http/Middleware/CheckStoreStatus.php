<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckStoreStatus
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle($request, Closure $next)
    {
        $store = $request->route('store'); // الحصول على المتجر من الطلب

        if (!$store->status) {
            return response()->json(['error' => 'تم تعطيل المتجر بسبب فشل الدفع.'], 403);
        }

        return $next($request);
    }
}
