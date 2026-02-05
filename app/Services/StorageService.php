<?php

namespace App\Services;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;

class StorageService
{
    public function storePrivateFile(UploadedFile $file): string
    {
        return Storage::disk('local')->putFile('private', $file);
    }
}
