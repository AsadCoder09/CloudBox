<?php

namespace App\Services;

class ShareService
{
    public function store($user, array $payload)
    {
        return ['message' => 'store'];
    }

    public function show(string $token)
    {
        return ['message' => 'show'];
    }

    public function verify(string $token, array $payload)
    {
        return ['message' => 'verify'];
    }

    public function logs(string $token)
    {
        return ['message' => 'logs'];
    }
}
