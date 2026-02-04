<?php

namespace App\Services;

class FileService
{
    public function upload($user, array $payload)
    {
        return ['message' => 'upload'];
    }

    public function show(string $id)
    {
        return ['message' => 'show'];
    }

    public function download(string $id)
    {
        return ['message' => 'download'];
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
