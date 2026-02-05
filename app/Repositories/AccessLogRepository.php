<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class AccessLogRepository
{
    public function create(array $attributes): void
    {
        DB::table('access_logs')->insert($attributes);
    }
}
