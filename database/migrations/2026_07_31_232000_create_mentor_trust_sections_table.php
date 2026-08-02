<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('mentor_trust_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('badge_text', 120);
            $table->string('heading_prefix', 80);
            $table->string('heading_accent', 120);
            $table->text('intro_paragraph');
            $table->json('body_paragraphs');
            $table->json('highlights');
            $table->string('cta_label', 120);
            $table->string('cta_url');
            $table->string('cta_note', 255);
            $table->json('gallery_cards');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('mentor_trust_sections');
    }
};
