<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class PaymentProof extends Model
{
    use HasFactory;

    public const STATUS_PENDING_REVIEW = 'pending_review';
    public const STATUS_APPROVED = 'approved';
    public const STATUS_REJECTED = 'rejected';

    protected $fillable = [
        'submission_id',
        'full_name',
        'whatsapp_number',
        'email',
        'transaction_reference',
        'sender_account_last4',
        'amount_paid',
        'notes',
        'payment_method',
        'program_id',
        'session_type',
        'payment_proof_path',
        'payment_proof_original_name',
        'payment_proof_mime_type',
        'payment_proof_size',
        'status',
        'duplicate_submission',
    ];

    protected $casts = [
        'duplicate_submission' => 'boolean',
    ];

    public static function statuses(): array
    {
        return [
            self::STATUS_PENDING_REVIEW,
            self::STATUS_APPROVED,
            self::STATUS_REJECTED,
        ];
    }

    public static function generateSubmissionId(): string
    {
        do {
            $submissionId = 'pay_' . Str::lower(Str::random(10));
        } while (static::where('submission_id', $submissionId)->exists());

        return $submissionId;
    }
}
