<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MediaProofSection extends Model
{
    protected $fillable = [
        'page_key',
        'badge_text',
        'heading',
        'description',
        'video_items',
        'review_items',
        'is_active',
    ];

    protected $casts = [
        'video_items' => 'array',
        'review_items' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultVideoItems(): array
    {
        return [
            [
                'title' => 'Student Success Call',
                'subtitle' => 'Scholarship roadmap breakdown',
                'image' => '/src/assets/video-proof-placeholder.svg',
            ],
            [
                'title' => 'Consultation Clip',
                'subtitle' => 'Profile review session',
                'image' => '/src/assets/video-proof-placeholder.svg',
            ],
            [
                'title' => 'Application Strategy',
                'subtitle' => 'Shortlisting and planning',
                'image' => '/src/assets/video-proof-placeholder.svg',
            ],
            [
                'title' => 'Winning SOP Feedback',
                'subtitle' => 'Live document guidance',
                'image' => '/src/assets/video-proof-placeholder.svg',
            ],
        ];
    }

    public static function defaultReviewItems(): array
    {
        return [
            [
                'title' => 'Family success moment',
                'subtitle' => 'A real proof image from GMC student results',
                'image' => '/family2.jpg',
            ],
            [
                'title' => 'Scholarship celebration',
                'subtitle' => 'Another trust-building family result photo',
                'image' => '/family3.jpg',
            ],
            [
                'title' => 'Consultation feedback',
                'subtitle' => 'Helped organize the full process',
                'image' => '/src/assets/review-proof-placeholder.svg',
            ],
            [
                'title' => 'Application support review',
                'subtitle' => 'More confidence before deadlines',
                'image' => '/src/assets/review-proof-placeholder.svg',
            ],
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'badge_text' => 'Real Proof',
            'heading' => 'Real conversations. Real feedback.',
            'description' => 'Use this area for student call clips and review screenshots so visitors see trust signals without needing long paragraphs.',
            'video_items' => self::defaultVideoItems(),
            'review_items' => self::defaultReviewItems(),
            'is_active' => true,
        ];
    }
}
