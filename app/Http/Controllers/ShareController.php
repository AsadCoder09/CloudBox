<?php

namespace App\Http\Controllers;

use App\Services\ShareService;
use Illuminate\Http\Request;

class ShareController
{
    public function __construct(private ShareService $shareService)
    {
    }

    public function store(Request $request)
    {
        return $this->shareService->store($request->user(), $request->all());
    }

    public function show(string $token)
    {
        return $this->shareService->show($token);
    }

    public function verify(Request $request, string $token)
    {
        return $this->shareService->verify($token, $request->all());
    }

    public function logs(string $token)
    {
        return $this->shareService->logs($token);
    }
}
