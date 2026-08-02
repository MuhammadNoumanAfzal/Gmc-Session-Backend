<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FaqSection extends Model
{
    protected $fillable = [
        'page_key',
        'badge_text',
        'heading_line1',
        'heading_line2',
        'description',
        'faq_items',
        'is_active',
    ];

    protected $casts = [
        'faq_items' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultFaqItems(): array
    {
        return [
            [
                'question' => 'Who is this consultation best for?',
                'answer' => 'It is best for students who want clearer scholarship direction, better university shortlisting, stronger SOP guidance, and honest feedback before applying.',
            ],
            [
                'question' => 'Will you help me choose the university & scholarship?',
                'answer' => 'Yes. The session is designed to help you think more strategically about scholarship fit, university options, and where your profile has the best chance.',
            ],
            [
                'question' => 'Do you review SOPs and supporting documents too?',
                'answer' => 'Yes. We can discuss how to improve your SOP, documents, and overall presentation so your application feels stronger and more intentional.',
            ],
            [
                'question' => 'Is this only for students with strong profiles?',
                'answer' => 'No. It is also helpful for students starting from zero who need a roadmap, realistic expectations, and a better understanding of how to move forward.',
            ],
            [
                'question' => 'Will this guarantee a scholarship?',
                'answer' => 'No one can honestly guarantee that. What this session does offer is clearer strategy, fewer weak decisions, and better preparation for funded admissions.',
            ],
            [
                'question' => 'What happens after the consultation?',
                'answer' => 'You leave with more clarity on next steps, profile direction, application priorities, and what needs improvement before you start applying seriously.',
            ],
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'badge_text' => 'Frequently Asked Questions',
            'heading_line1' => 'Common questions before',
            'heading_line2' => 'booking your consultation.',
            'description' => 'Short, direct answers so students know exactly what this session helps with and what it does not promise.',
            'faq_items' => self::defaultFaqItems(),
            'is_active' => true,
        ];
    }
}
