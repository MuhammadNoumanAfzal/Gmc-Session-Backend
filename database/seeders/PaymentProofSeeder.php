<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\PaymentProof;
use Illuminate\Support\Carbon;
use Illuminate\Support\Str;

class PaymentProofSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Truncate existing data to start clean
        PaymentProof::truncate();

        $names = [
            'Ahmad Ali', 'Fatima Zahra', 'Muhammad Usman', 'Ayesha Khan', 'Zainab Bibi',
            'Hamza Sheikh', 'Sana Malik', 'Bilal Ahmed', 'Mariam Yusuf', 'Omar Farooq',
            'Sara Niaz', 'Mustafa Qureshi', 'Hafsa Tariq', 'Ali Raza', 'Laiba Shah',
            'Junaid Khan', 'Hira Jamil', 'Waqas Azeem', 'Mahnoor Asif', 'Saad Siddiqui'
        ];

        $paymentMethods = ['Bank Transfer', 'JazzCash', 'EasyPaisa', 'Stripe'];
        $programs = ['prog_fullstack_web', 'prog_data_analytics', 'prog_uiux_design', 'prog_mobile_app'];
        $programNames = [
            'prog_fullstack_web' => 'Full-Stack Web Development',
            'prog_data_analytics' => 'Data Analytics Masterclass',
            'prog_uiux_design' => 'UI/UX Product Design',
            'prog_mobile_app' => 'Mobile App Development (React Native)'
        ];

        $sessionTypes = ['1-on-1 Mentorship', 'Weekend Bootcamp', 'Group Session', 'Self-Paced Mentorship'];
        $statuses = [
            PaymentProof::STATUS_APPROVED, 
            PaymentProof::STATUS_APPROVED, 
            PaymentProof::STATUS_APPROVED, // weight APPROVED more
            PaymentProof::STATUS_PENDING_REVIEW, 
            PaymentProof::STATUS_PENDING_REVIEW,
            PaymentProof::STATUS_REJECTED
        ];

        $now = Carbon::now();

        for ($i = 0; $i < 30; $i++) {
            $name = $names[$i % count($names)];
            $email = strtolower(str_replace(' ', '.', $name)) . rand(10, 99) . '@gmail.com';
            $date = Carbon::parse($now)->subDays(30 - $i)->subHours(rand(1, 23))->subMinutes(rand(1, 59));
            
            $method = $paymentMethods[rand(0, count($paymentMethods) - 1)];
            $program = $programs[rand(0, count($programs) - 1)];
            $session = $sessionTypes[rand(0, count($sessionTypes) - 1)];
            $status = $statuses[rand(0, count($statuses) - 1)];
            
            // Random amount based on session/program
            $amount = [99.00, 149.00, 199.00, 249.00, 299.00][rand(0, 4)];
            if ($status === PaymentProof::STATUS_REJECTED) {
                $notes = 'Invalid reference number provided. Please upload correct receipt screenshot.';
            } else {
                $notes = rand(0, 3) === 0 ? 'Urgent verification requested. Thank you!' : null;
            }

            PaymentProof::create([
                'submission_id' => PaymentProof::generateSubmissionId(),
                'full_name' => $name,
                'whatsapp_number' => '+923' . rand(100000000, 999999999),
                'email' => $email,
                'transaction_reference' => 'TXN' . rand(10000000, 99999999) . strtoupper(Str::random(4)),
                'sender_account_last4' => (string)rand(1000, 9999),
                'amount_paid' => $amount,
                'notes' => $notes,
                'payment_method' => $method,
                'program_id' => $program,
                'session_type' => $session,
                'payment_proof_path' => 'payment-proofs/dummy_receipt_' . ($i + 1) . '.pdf',
                'payment_proof_original_name' => 'receipt_' . ($i + 1) . '.pdf',
                'payment_proof_mime_type' => 'application/pdf',
                'payment_proof_size' => rand(102400, 2048000),
                'status' => $status,
                'duplicate_submission' => rand(1, 15) === 1, // small chance of duplicate
                'created_at' => $date,
                'updated_at' => $date,
            ]);
        }
    }
}
