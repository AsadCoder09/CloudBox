<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Laravel\Sanctum\Sanctum;
use Tests\TestCase;

class FileUploadTest extends TestCase
{
    use RefreshDatabase;

    public function test_authenticated_user_can_upload_file(): void
    {
        Storage::fake('local');

        $user = User::query()->create([
            'name' => 'Upload User',
            'email' => 'upload@example.com',
            'password' => bcrypt('password123'),
        ]);

        Sanctum::actingAs($user);

        $response = $this->postJson('/api/files/upload', [
            'file' => UploadedFile::fake()->create('document.pdf', 100, 'application/pdf'),
        ]);

        $response->assertStatus(201)
            ->assertJsonStructure(['message', 'file' => ['id', 'filename', 'encrypted_path', 'size', 'owner_id']]);

        $this->assertNotEmpty(Storage::disk('local')->allFiles('private'));
        $this->assertDatabaseHas('files', ['owner_id' => $user->id]);
    }
}
