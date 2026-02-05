<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class FileRepository
{
    public function create(array $attributes): array
    {
        $id = DB::table('files')->insertGetId($attributes);

        return (array) DB::table('files')->where('id', $id)->first();
    }
}
