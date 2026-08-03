<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('enrollment_flow_sections', function (Blueprint $table) {
            $table->id();
            $table->string('page_key')->unique();
            $table->string('header_badge_text', 160);
            $table->string('header_heading_line1', 160);
            $table->string('header_heading_highlight', 160);
            $table->string('back_button_text', 80);
            $table->json('step_items');
            $table->string('summary_badge_text', 120);
            $table->string('summary_heading', 120);
            $table->string('summary_subtitle', 320);
            $table->string('price_label', 120);
            $table->string('discounted_price', 40);
            $table->string('discounted_amount_value', 20);
            $table->string('original_price', 40);
            $table->string('urgency_text', 60);
            $table->unsignedTinyInteger('progress_percentage')->default(90);
            $table->string('includes_heading', 120);
            $table->json('includes_items');
            $table->string('summary_button_text', 80);
            $table->string('transfer_title', 120);
            $table->json('bank_details');
            $table->string('support_notes_heading', 120);
            $table->json('support_notes');
            $table->string('transfer_back_button_text', 50);
            $table->string('transfer_button_text', 80);
            $table->string('proof_badge_text', 120);
            $table->string('proof_heading', 160);
            $table->string('proof_warning_text', 240);
            $table->string('proof_support_text', 80);
            $table->string('proof_back_button_text', 50);
            $table->string('proof_submit_button_text', 80);
            $table->string('meta_program_id', 120);
            $table->string('meta_session_type', 120);
            $table->string('meta_payment_method', 80);
            $table->boolean('is_active')->default(true);
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('enrollment_flow_sections');
    }
};
