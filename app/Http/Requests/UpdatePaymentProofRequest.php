<?php

namespace App\Http\Requests;

use App\Models\PaymentProof;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentProofRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'full_name' => ['required', 'string', 'max:255'],
            'whatsapp_number' => ['required', 'string', 'regex:/^\+?\d{10,20}$/'],
            'email' => ['required', 'email', 'max:255'],
            'transaction_reference' => ['required', 'string', 'max:255'],
            'sender_account_last4' => ['nullable', 'digits:4'],
            'amount_paid' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'payment_method' => ['required', 'string', 'max:100'],
            'program_id' => ['required', 'string', 'max:100'],
            'session_type' => ['required', 'string', 'max:255'],
            'status' => ['required', Rule::in(PaymentProof::statuses())],
            'duplicate_submission' => ['nullable', 'boolean'],
        ];
    }
}
