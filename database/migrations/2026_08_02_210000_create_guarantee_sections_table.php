<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('guarantee_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('top_badge_text', 160);
            $table->string('section_badge_text', 120);
            $table->string('heading_line1', 120);
            $table->string('heading_line2', 120);
            $table->text('description');
            $table->json('guarantee_points');
            $table->string('principle_label', 80);
            $table->string('principle_title', 140);
            $table->string('principle_description', 220);
            $table->string('seal_badge_text', 120);
            $table->string('seal_value_text', 40);
            $table->string('seal_footer_text', 160);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('guarantee_sections');
    }
};
