<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('watch_later_videos', function (Blueprint $table) {
            $table->id();
            $table->string('platform');
            $table->string('video_id');
            $table->foreignIdFor(User::class);
            $table->string('url');
            $table->string('title')->nullable();
            $table->string('thumbnail')->nullable();
            $table->boolean('watched')->default(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('watch_later_videos');
    }
};
