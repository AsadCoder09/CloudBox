<?php

namespace App\Services;

use App\Repositories\FileRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class FileService
{
    public function __construct(
        private FileRepository $fileRepository,
        private StorageService $storageService,
        private EncryptionService $encryptionService,
        private ActivityLogService $activityLogService
    ) {
    }

    public function upload($user, array $payload): JsonResponse
    {
        $validator = Validator::make($payload, [
            'file' => ['required', 'file', 'max:10240', 'mimes:jpg,jpeg,png,pdf,doc,docx,txt'],
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }

        $file = $payload['file'];
        $storedPath = $this->storageService->storePrivateFile($file);
        $encryptedPath = $this->encryptionService->encrypt($storedPath);

        $record = $this->fileRepository->create([
            'filename' => $file->getClientOriginalName(),
            'encrypted_path' => $encryptedPath,
            'size' => $file->getSize(),
            'owner_id' => $user->id,
            'visibility' => 'private',
            'is_trashed' => false,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        $this->activityLogService->record('file_upload', [
            'user_id' => $user->id,
        ]);

        return response()->json([
            'message' => 'File uploaded',
            'file' => $record,
        ], 201);
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
