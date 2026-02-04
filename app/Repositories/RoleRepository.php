<?php

namespace App\Repositories;

use Illuminate\Support\Facades\DB;

class RoleRepository
{
    public function getOrCreateDefaultRoleId(): int
    {
        $role = DB::table('roles')->where('name', 'user')->first();

        if ($role) {
            return (int) $role->id;
        }

        return (int) DB::table('roles')->insertGetId([
            'name' => 'user',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
