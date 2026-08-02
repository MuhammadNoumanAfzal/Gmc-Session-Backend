<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('media_proof_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('badge_text', 120);
            $table->string('heading', 160);
            $table->string('description', 400);
            $table->json('video_items');
            $table->json('review_items');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('media_proof_sections');
    }
};
