<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('strategy_ribbon_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->json('front_ribbon_items');
            $table->json('back_ribbon_items');
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('strategy_ribbon_sections');
    }
};
