<?php

declare(strict_types=1);

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {

    public function up(): void
    {
        Schema::create('edit_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->foreignIdFor(Post::class);
            $table->string('action');
            $table->string('title')->nullable();
            $table->string('originalTitle');
            $table->text('description')->nullable();
            $table->text('originalDescription');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('edit_requests');
    }
};
