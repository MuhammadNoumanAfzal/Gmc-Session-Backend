<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class StorePaymentProofRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function prepareForValidation(): void
    {
        $whatsappNumber = preg_replace('/[^\d+]/', '', (string) $this->input('whatsappNumber'));
        $senderAccountLast4 = preg_replace('/\D/', '', (string) $this->input('senderAccountLast4'));

        $this->merge([
            'fullName' => trim((string) $this->input('fullName')),
            'whatsappNumber' => $whatsappNumber,
            'email' => trim((string) $this->input('email')),
            'transactionReference' => trim((string) $this->input('transactionReference')),
            'senderAccountLast4' => $senderAccountLast4 !== '' ? substr($senderAccountLast4, -4) : null,
            'amountPaid' => trim((string) $this->input('amountPaid')),
            'notes' => trim((string) $this->input('notes')),
            'paymentMethod' => trim((string) $this->input('paymentMethod')),
            'programId' => trim((string) $this->input('programId')),
            'sessionType' => trim((string) $this->input('sessionType')),
        ]);
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'fullName' => ['required', 'string', 'max:255'],
            'whatsappNumber' => ['required', 'string', 'regex:/^\+?\d{10,20}$/'],
            'email' => ['required', 'email', 'max:255'],
            'transactionReference' => ['required', 'string', 'max:255'],
            'senderAccountLast4' => ['nullable', 'digits:4'],
            'amountPaid' => ['required', 'numeric', 'min:0'],
            'notes' => ['nullable', 'string', 'max:2000'],
            'paymentMethod' => ['required', 'string', 'max:100'],
            'programId' => ['required', 'string', 'max:100'],
            'sessionType' => ['required', 'string', 'max:255'],
            'paymentProof' => ['required', 'file', 'mimes:pdf,jpg,jpeg,png', 'max:10240'],
        ];
    }

    public function messages(): array
    {
        return [
            'whatsappNumber.regex' => 'WhatsApp number must contain 10 to 20 digits after cleanup.',
            'paymentProof.max' => 'Payment proof may not be greater than 10MB.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json([
            'success' => false,
            'message' => 'Validation failed.',
            'errors' => $validator->errors(),
        ], 422));
    }
}
