<?php

namespace App\Http\Controllers;

use App\Services\AdminService;

class AdminController
{
    public function __construct(private AdminService $adminService)
    {
    }

    public function users()
    {
        return $this->adminService->users();
    }

    public function storage()
    {
        return $this->adminService->storage();
    }

    public function logs()
    {
        return $this->adminService->logs();
    }
}
