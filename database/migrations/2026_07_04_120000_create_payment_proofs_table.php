<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('payment_proofs', function (Blueprint $table) {
            $table->id();
            $table->string('submission_id')->unique();
            $table->string('full_name');
            $table->string('whatsapp_number', 20);
            $table->string('email');
            $table->string('transaction_reference');
            $table->string('sender_account_last4', 4)->nullable();
            $table->decimal('amount_paid', 10, 2);
            $table->text('notes')->nullable();
            $table->string('payment_method');
            $table->string('program_id');
            $table->string('session_type');
            $table->string('payment_proof_path');
            $table->string('payment_proof_original_name');
            $table->string('payment_proof_mime_type', 100);
            $table->unsignedBigInteger('payment_proof_size');
            $table->string('status')->default('pending_review');
            $table->boolean('duplicate_submission')->default(false);
            $table->timestamps();

            $table->index(['transaction_reference']);
            $table->index(['email', 'created_at']);
            $table->index(['status']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('payment_proofs');
    }
};
