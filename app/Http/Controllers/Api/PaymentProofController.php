<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\StorePaymentProofRequest;
use App\Models\PaymentProof;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Storage;

class PaymentProofController extends Controller
{
    public function store(StorePaymentProofRequest $request): JsonResponse
    {
        $duplicateSubmission = PaymentProof::query()
            ->where(function ($query) use ($request) {
                $query->where('transaction_reference', $request->transactionReference)
                    ->orWhere(function ($innerQuery) use ($request) {
                        $innerQuery->where('email', $request->email)
                            ->whereDate('created_at', Carbon::today())
                            ->where('program_id', $request->programId);
                    });
            })
            ->exists();

        $proofFile = $request->file('paymentProof');
        $storedPath = $proofFile->store('payment-proofs', 'local');

        $paymentProof = PaymentProof::create([
            'submission_id' => PaymentProof::generateSubmissionId(),
            'full_name' => $request->fullName,
            'whatsapp_number' => $request->whatsappNumber,
            'email' => $request->email,
            'transaction_reference' => $request->transactionReference,
            'sender_account_last4' => $request->senderAccountLast4,
            'amount_paid' => number_format((float) $request->amountPaid, 2, '.', ''),
            'notes' => $request->notes,
            'payment_method' => $request->paymentMethod,
            'program_id' => $request->programId,
            'session_type' => $request->sessionType,
            'payment_proof_path' => $storedPath,
            'payment_proof_original_name' => $proofFile->getClientOriginalName(),
            'payment_proof_mime_type' => $proofFile->getClientMimeType() ?: $proofFile->getMimeType(),
            'payment_proof_size' => $proofFile->getSize(),
            'status' => PaymentProof::STATUS_PENDING_REVIEW,
            'duplicate_submission' => $duplicateSubmission,
        ]);

        return response()->json([
            'success' => true,
            'submissionId' => $paymentProof->submission_id,
            'status' => $paymentProof->status,
            'message' => 'Payment proof submitted successfully.',
            'createdAt' => $paymentProof->created_at->toISOString(),
        ], 201);
    }
}
