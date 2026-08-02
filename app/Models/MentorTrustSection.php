<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MentorTrustSection extends Model
{
    protected $fillable = [
        'page_key',
        'badge_text',
        'heading_prefix',
        'heading_accent',
        'intro_paragraph',
        'body_paragraphs',
        'highlights',
        'cta_label',
        'cta_url',
        'cta_note',
        'gallery_cards',
        'is_active',
    ];

    protected $casts = [
        'body_paragraphs' => 'array',
        'highlights' => 'array',
        'gallery_cards' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultBodyParagraphs(): array
    {
        return [
            'Our process is built on real strategies, not guesswork. We help you identify weak spots in your SOP, shortlists, and documents early, saving you months of blind applications, expensive mistakes, and frustrating rejections.',
            'Whether you are targeting global admits or looking for specific funding paths, GMC provides a clear, step-by-step roadmap. We focus on matching your academic strength to programs where your profile stands a high chance of fully-funded offers.',
        ];
    }

    public static function defaultHighlights(): array
    {
        return [
            [
                'label' => 'Direction',
                'text' => 'Know where to apply and why.',
            ],
            [
                'label' => 'Feedback',
                'text' => 'Improve your documents fast.',
            ],
            [
                'label' => 'Clarity',
                'text' => 'Move with a cleaner plan.',
            ],
        ];
    }

    public static function defaultGalleryCards(): array
    {
        return [
            [
                'image' => '/photo.png',
                'title' => 'Scholarship Strategy',
                'copy' => 'Shape a stronger plan before you spend months applying.',
            ],
            [
                'image' => '/family2.jpg',
                'title' => 'Profile Review',
                'copy' => 'See where your application already stands out and where it needs work.',
            ],
            [
                'image' => '/family3.jpg',
                'title' => 'University Match',
                'copy' => 'Focus on programs where your profile and funding goals align better.',
            ],
            [
                'image' => '/family4.png',
                'title' => 'Admission Success',
                'copy' => 'Candid moments of students celebrating fully funded admits.',
            ],
            [
                'image' => '/family5.png',
                'title' => 'Funding Secured',
                'copy' => 'Join the community of students who got fully-funded guidance.',
            ],
            [
                'image' => '/hero.png',
                'title' => 'Application Clarity',
                'copy' => 'Move with cleaner next steps instead of second-guessing every choice.',
            ],
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'badge_text' => 'Your Scholarship Mentor',
            'heading_prefix' => 'Meet',
            'heading_accent' => 'GMC Guidance',
            'intro_paragraph' => 'Strategic mentorship for students who want sharper scholarship decisions, cleaner positioning, and a more confident global application path. We work closely with you to dissect your profile, evaluate your funding chances, and optimize every piece of your application.',
            'body_paragraphs' => self::defaultBodyParagraphs(),
            'highlights' => self::defaultHighlights(),
            'cta_label' => 'Book a Consultation',
            'cta_url' => '/program',
            'cta_note' => 'Replace the gallery photos with real student or mentor images anytime.',
            'gallery_cards' => self::defaultGalleryCards(),
            'is_active' => true,
        ];
    }
}
