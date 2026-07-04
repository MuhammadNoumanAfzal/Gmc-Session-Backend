<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UpdatePaymentProofRequest;
use App\Models\PaymentProof;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class PaymentProofController extends Controller
{
    public function index(): View
    {
        $values = PaymentProof::latest()->get();
        $data = [
            'heading' => 'Payment Proofs',
            'title' => 'View Payment Proof Submissions',
            'active' => 'payment_proofs',
            'values' => $values,
        ];

        return view('admin.payment_proofs.index', $data);
    }

    public function show(string $id): View
    {
        $paymentProof = PaymentProof::findOrFail($id);
        $data = [
            'heading' => 'Payment Proofs',
            'title' => 'Payment Proof Details',
            'active' => 'payment_proofs',
            'paymentProof' => $paymentProof,
            'statuses' => PaymentProof::statuses(),
        ];

        return view('admin.payment_proofs.show', $data);
    }

    public function edit(string $id): View
    {
        $paymentProof = PaymentProof::findOrFail($id);
        $data = [
            'heading' => 'Payment Proofs',
            'title' => 'Edit Payment Proof Submission',
            'active' => 'payment_proofs',
            'paymentProof' => $paymentProof,
            'statuses' => PaymentProof::statuses(),
        ];

        return view('admin.payment_proofs.edit', $data);
    }

    public function update(UpdatePaymentProofRequest $request): RedirectResponse
    {
        $paymentProof = PaymentProof::findOrFail($request->id);
        $paymentProof->update($request->validated());

        return redirect()->route('payment-proofs.index')
            ->with('success', 'Payment proof submission updated successfully.');
    }

    public function destroy(string $id): RedirectResponse
    {
        $paymentProof = PaymentProof::findOrFail($id);

        if (Storage::disk('local')->exists($paymentProof->payment_proof_path)) {
            Storage::disk('local')->delete($paymentProof->payment_proof_path);
        }

        $paymentProof->delete();

        return redirect()->route('payment-proofs.index')
            ->with('success', 'Payment proof submission deleted successfully.');
    }

    public function download(string $id)
    {
        $paymentProof = PaymentProof::findOrFail($id);

        abort_unless(Storage::disk('local')->exists($paymentProof->payment_proof_path), 404);

        return Storage::disk('local')->download(
            $paymentProof->payment_proof_path,
            $paymentProof->payment_proof_original_name
        );
    }

    public function slip(string $id): \Illuminate\View\View
    {
        $paymentProof = PaymentProof::findOrFail($id);
        $data = [
            'paymentProof' => $paymentProof,
        ];

        return view('admin.payment_proofs.slip', $data);
    }
}
