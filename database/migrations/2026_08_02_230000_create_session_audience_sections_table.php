<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('session_audience_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('badge_text', 160);
            $table->string('heading_line1', 120);
            $table->string('heading_line2', 120);
            $table->text('description');
            $table->json('audience_cards');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('session_audience_sections');
    }
};
