<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ScholarshipSolutionSection extends Model
{
    protected $fillable = [
        'page_key',
        'badge_text',
        'heading',
        'feature_pills',
        'workflow_cards',
        'cta_label',
        'cta_url',
        'is_active',
    ];

    protected $casts = [
        'feature_pills' => 'array',
        'workflow_cards' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultFeaturePills(): array
    {
        return [
            'Clear direction',
            'Honest profile feedback',
            'Stronger scholarship applications',
        ];
    }

    public static function defaultWorkflowCards(): array
    {
        return [
            [
                'icon_key' => 'GraduationCap',
                'title' => 'University Match',
                'description' => 'Shortlist smarter with universities that match your funding chances.',
                'details' => 'We help you avoid random applications and focus on programs where your profile, budget, and scholarship potential align.',
            ],
            [
                'icon_key' => 'MessageSquareText',
                'title' => 'SOP Storyline',
                'description' => 'Tell your story clearly so your application reads with purpose.',
                'details' => 'Shape your motivation, achievements, and career direction into an SOP structure that feels sharper and more convincing.',
            ],
            [
                'icon_key' => 'FileCheck2',
                'title' => 'Document Review',
                'description' => 'Catch weak spots early before they turn into expensive mistakes.',
                'details' => 'We flag missing proof, weak framing, and presentation gaps across the documents that matter most for scholarship review.',
            ],
            [
                'icon_key' => 'Target',
                'title' => 'Deadline Roadmap',
                'description' => 'Know the next move with a cleaner timeline and fewer blind spots.',
                'details' => 'Get a more realistic application order so you know what to prepare first, what to improve next, and when to submit.',
            ],
            [
                'icon_key' => 'BrainCircuit',
                'title' => 'Profile Strategy',
                'description' => 'Strengthen your positioning before you start sending applications.',
                'details' => 'We identify what makes your profile competitive and what needs improvement so your effort goes into the right upgrades.',
            ],
            [
                'icon_key' => 'CalendarClock',
                'title' => 'Application Timing',
                'description' => 'Move with better timing instead of rushing near deadlines.',
                'details' => 'Plan your scholarship journey around document readiness, exam timing, shortlist quality, and realistic submission windows.',
            ],
            [
                'icon_key' => 'BookOpenCheck',
                'title' => 'Scholarship Fit',
                'description' => 'Focus on opportunities that make sense for your academic direction.',
                'details' => 'We help filter out mismatched programs and highlight scholarship routes where your background has a stronger case.',
            ],
            [
                'icon_key' => 'Handshake',
                'title' => 'Consultation Clarity',
                'description' => 'Leave the session knowing exactly what to do next.',
                'details' => 'You walk away with clearer priorities, fewer distractions, and a more confident plan for applications and funding.',
            ],
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'badge_text' => 'A smarter path for ambitious scholarship applicants',
            'heading' => 'Stop guessing and build a winning scholarship plan around your profile.',
            'feature_pills' => self::defaultFeaturePills(),
            'workflow_cards' => self::defaultWorkflowCards(),
            'cta_label' => 'Book Your Consultation',
            'cta_url' => '/program',
            'is_active' => true,
        ];
    }
}
