<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('scholarship_solution_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('badge_text');
            $table->string('heading');
            $table->json('feature_pills');
            $table->json('workflow_cards');
            $table->string('cta_label', 120);
            $table->string('cta_url');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('scholarship_solution_sections');
    }
};
