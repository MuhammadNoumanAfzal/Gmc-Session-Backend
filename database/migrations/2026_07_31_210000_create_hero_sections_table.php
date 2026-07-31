<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('hero_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('announcement_text');
            $table->string('badge_text');
            $table->json('title_messages');
            $table->string('hero_image_url', 2048);
            $table->string('hero_image_alt');
            $table->string('cta_eyebrow', 80);
            $table->string('cta_label', 120);
            $table->string('cta_url');
            $table->string('trust_title');
            $table->text('trust_description');
            $table->unsignedTinyInteger('trust_avatar_count')->default(4);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('hero_sections');
    }
};
