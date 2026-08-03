<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EnrollmentFlowSection extends Model
{
    protected $fillable = [
        'page_key',
        'header_badge_text',
        'header_heading_line1',
        'header_heading_highlight',
        'back_button_text',
        'step_items',
        'summary_badge_text',
        'summary_heading',
        'summary_subtitle',
        'price_label',
        'discounted_price',
        'discounted_amount_value',
        'original_price',
        'urgency_text',
        'progress_percentage',
        'includes_heading',
        'includes_items',
        'summary_button_text',
        'transfer_title',
        'bank_details',
        'support_notes_heading',
        'support_notes',
        'transfer_back_button_text',
        'transfer_button_text',
        'proof_badge_text',
        'proof_heading',
        'proof_warning_text',
        'proof_support_text',
        'proof_back_button_text',
        'proof_submit_button_text',
        'meta_program_id',
        'meta_session_type',
        'meta_payment_method',
        'is_active',
    ];

    protected $casts = [
        'step_items' => 'array',
        'includes_items' => 'array',
        'bank_details' => 'array',
        'support_notes' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'program';

    public static function defaultStepItems(): array
    {
        return [
            ['step' => 1, 'label' => 'Review Slot'],
            ['step' => 2, 'label' => 'Bank Transfer'],
            ['step' => 3, 'label' => 'Verify Proof'],
        ];
    }

    public static function defaultIncludesItems(): array
    {
        return [
            'University shortlist direction',
            'Scholarship fit and profile feedback',
            'SOP and document improvement points',
            'Clear next-step roadmap after the session',
        ];
    }

    public static function defaultBankDetails(): array
    {
        return [
            ['label' => 'Bank', 'value' => 'Allied Bank PVT LTD'],
            ['label' => 'Account Title', 'value' => 'GMC Consultancy'],
            ['label' => 'Account Number', 'value' => '10710010086384360019'],
            ['label' => 'IBAN', 'value' => 'PK56ABPA0010086384360019'],
        ];
    }

    public static function defaultSupportNotes(): array
    {
        return [
            'Fake screenshots are manually rejected and the booking is not approved.',
            'If upload does not work, send your screenshot on WhatsApp support after payment.',
            'Use the same phone number you want GMC to contact for your consultation.',
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'header_badge_text' => 'GMC Scholarship Consultancy',
            'header_heading_line1' => 'Complete your booking with a',
            'header_heading_highlight' => 'clean, verified payment.',
            'back_button_text' => 'Back to landing page',
            'step_items' => self::defaultStepItems(),
            'summary_badge_text' => 'Priority booking window',
            'summary_heading' => 'Get enrolled now.',
            'summary_subtitle' => 'Secure your GMC strategy session, upload your payment proof, and get manually verified before your consultation is confirmed.',
            'price_label' => 'Discounted Slot Price',
            'discounted_price' => 'Rs. 4,900',
            'discounted_amount_value' => '4900',
            'original_price' => 'Rs. 8,000',
            'urgency_text' => '90% Filled',
            'progress_percentage' => 90,
            'includes_heading' => 'What is included in the session',
            'includes_items' => self::defaultIncludesItems(),
            'summary_button_text' => 'Continue to Payment',
            'transfer_title' => 'Online Bank Transfer',
            'bank_details' => self::defaultBankDetails(),
            'support_notes_heading' => 'Important checkout notes',
            'support_notes' => self::defaultSupportNotes(),
            'transfer_back_button_text' => 'Back',
            'transfer_button_text' => 'I\'ve Made Payment',
            'proof_badge_text' => 'Upload Payment Proof',
            'proof_heading' => 'Submit screenshot for manual verification.',
            'proof_warning_text' => 'Do not upload a fake screenshot. GMC reviews payments manually before confirming booking.',
            'proof_support_text' => 'Chat with WhatsApp Support',
            'proof_back_button_text' => 'Back',
            'proof_submit_button_text' => 'Submit Proof',
            'meta_program_id' => 'gmc-scholarship-consultation',
            'meta_session_type' => 'GMC Scholarship Consultation',
            'meta_payment_method' => 'bank_transfer',
            'is_active' => true,
        ];
    }
}
