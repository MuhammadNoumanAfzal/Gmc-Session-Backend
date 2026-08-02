<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SessionAudienceSection extends Model
{
    protected $fillable = [
        'page_key',
        'badge_text',
        'heading_line1',
        'heading_line2',
        'description',
        'audience_cards',
        'is_active',
    ];

    protected $casts = [
        'audience_cards' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultAudienceCards(): array
    {
        return [
            [
                'icon_key' => 'graduation-cap',
                'title' => 'Students planning funded admissions',
                'description' => 'Ideal for applicants who want clearer direction before starting scholarship applications.',
            ],
            [
                'icon_key' => 'search-check',
                'title' => 'Students confused about where to apply',
                'description' => 'Best for those struggling with university shortlisting, fit, and scholarship targeting.',
            ],
            [
                'icon_key' => 'file-text',
                'title' => 'Students needing SOP and document guidance',
                'description' => 'Helpful if your documents feel weak, generic, or not aligned with your goals.',
            ],
            [
                'icon_key' => 'compass',
                'title' => 'Students who want a roadmap, not random advice',
                'description' => 'Perfect for serious applicants who want practical feedback and step-by-step clarity.',
            ],
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'badge_text' => 'For Whom Is This Session For?',
            'heading_line1' => 'Built for students who want',
            'heading_line2' => 'clarity before they apply.',
            'description' => 'This session is not for casual browsing. It is for students who want smarter decisions, stronger documents, and a cleaner scholarship roadmap.',
            'audience_cards' => self::defaultAudienceCards(),
            'is_active' => true,
        ];
    }
}
