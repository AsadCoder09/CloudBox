<?php

namespace App\Http\Middleware;

use App\Services\ActivityLogService;
use Closure;
use Illuminate\Http\Request;

class ActivityLogger
{
    public function __construct(private ActivityLogService $activityLogService)
    {
    }

    public function handle(Request $request, Closure $next)
    {
        $response = $next($request);

        $this->activityLogService->record('request', [
            'path' => $request->path(),
            'method' => $request->method(),
            'user_id' => optional($request->user())->id,
        ]);

        return $response;
    }
}
