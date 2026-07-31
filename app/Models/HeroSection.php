<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class HeroSection extends Model
{
    protected $fillable = [
        'page_key',
        'announcement_text',
        'badge_text',
        'title_messages',
        'hero_image_url',
        'hero_image_alt',
        'cta_eyebrow',
        'cta_label',
        'cta_url',
        'trust_title',
        'trust_description',
        'trust_avatar_count',
        'is_active',
    ];

    protected $casts = [
        'title_messages' => 'array',
        'is_active' => 'boolean',
        'trust_avatar_count' => 'integer',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultTitleMessages(): array
    {
        return [
            [
                'line1' => 'Win admission to top universities with',
                'line2' => 'fully funded scholarship guidance',
            ],
            [
                'line1' => 'Build a stronger profile for global admits',
                'line2' => 'with expert scholarship strategy',
            ],
            [
                'line1' => 'Turn your dream shortlist into real offers',
                'line2' => 'with clearer admission planning',
            ],
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'announcement_text' => 'Limited scholarship strategy slots open this week. Book early.',
            'badge_text' => 'Learn From Students Who Won Fully Funded Scholarships',
            'title_messages' => self::defaultTitleMessages(),
            'hero_image_url' => '/hero.png',
            'hero_image_alt' => 'GMC student scholarship winners group',
            'cta_eyebrow' => 'Start Here',
            'cta_label' => 'Book Consultation Session',
            'cta_url' => '/program',
            'trust_title' => 'Trusted by scholarship-focused students',
            'trust_description' => 'Profile guidance, document review, and a smarter admission roadmap.',
            'trust_avatar_count' => 4,
            'is_active' => true,
        ];
    }
}
