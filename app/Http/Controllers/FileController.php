<?php

namespace App\Http\Controllers;

use App\Services\FileService;
use Illuminate\Http\Request;

class FileController
{
    public function __construct(private FileService $fileService)
    {
    }

    public function upload(Request $request)
    {
        return $this->fileService->upload($request->user(), $request->all());
    }

    public function show(string $id)
    {
        return $this->fileService->show($id);
    }

    public function download(string $id)
    {
        return $this->fileService->download($id);
    }

    public function update(Request $request, string $id)
    {
        return $this->fileService->update($request->user(), $id, $request->all());
    }

    public function trash(Request $request, string $id)
    {
        return $this->fileService->trash($request->user(), $id);
    }

    public function restore(Request $request, string $id)
    {
        return $this->fileService->restore($request->user(), $id);
    }
}
