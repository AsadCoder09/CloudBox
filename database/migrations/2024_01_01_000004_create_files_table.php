<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('files', function (Blueprint $table) {
            $table->id();
            $table->string('filename');
            $table->string('encrypted_path');
            $table->unsignedBigInteger('size');
            $table->foreignId('owner_id')->constrained('users');
            $table->foreignId('folder_id')->nullable()->constrained('folders');
            $table->enum('visibility', ['private', 'shared'])->default('private');
            $table->boolean('is_trashed')->default(false);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('files');
    }
};
