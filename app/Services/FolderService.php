<?php

namespace App\Services;

class FolderService
{
    public function store($user, array $payload)
    {
        return ['message' => 'store'];
    }

    public function show(string $id)
    {
        return ['message' => 'show'];
    }

    public function update($user, string $id, array $payload)
    {
        return ['message' => 'update'];
    }

    public function trash($user, string $id)
    {
        return ['message' => 'trash'];
    }

    public function restore($user, string $id)
    {
        return ['message' => 'restore'];
    }
}
