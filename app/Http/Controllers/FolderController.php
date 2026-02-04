<?php

namespace App\Http\Controllers;

use App\Services\FolderService;
use Illuminate\Http\Request;

class FolderController
{
    public function __construct(private FolderService $folderService)
    {
    }

    public function store(Request $request)
    {
        return $this->folderService->store($request->user(), $request->all());
    }

    public function show(string $id)
    {
        return $this->folderService->show($id);
    }

    public function update(Request $request, string $id)
    {
        return $this->folderService->update($request->user(), $id, $request->all());
    }

    public function trash(Request $request, string $id)
    {
        return $this->folderService->trash($request->user(), $id);
    }

    public function restore(Request $request, string $id)
    {
        return $this->folderService->restore($request->user(), $id);
    }
}
