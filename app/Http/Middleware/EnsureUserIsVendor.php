<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserIsVendor
{
  public function handle(Request $request, Closure $next): Response
  {
    if (!$request->user() || !$request->user()->isVendor()) {
      abort(403, 'Vendors only.');
    }

    return $next($request);
  }
}
