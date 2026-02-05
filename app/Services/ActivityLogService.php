<?php

namespace App\Services;

use App\Repositories\AccessLogRepository;

class ActivityLogService
{
    public function __construct(private AccessLogRepository $accessLogRepository)
    {
    }

    public function record(string $action, array $context = []): void
    {
        $this->accessLogRepository->create([
            'share_link_id' => $context['share_link_id'] ?? null,
            'user_id' => $context['user_id'] ?? null,
            'action' => $action,
            'ip_address' => $context['ip_address'] ?? null,
            'user_agent' => $context['user_agent'] ?? null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
