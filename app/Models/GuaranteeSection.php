<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GuaranteeSection extends Model
{
    protected $fillable = [
        'page_key',
        'top_badge_text',
        'section_badge_text',
        'heading_line1',
        'heading_line2',
        'description',
        'guarantee_points',
        'principle_label',
        'principle_title',
        'principle_description',
        'seal_badge_text',
        'seal_value_text',
        'seal_footer_text',
        'is_active',
    ];

    protected $casts = [
        'guarantee_points' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultGuaranteePoints(): array
    {
        return [
            'Attend the consultation and follow the guidance seriously.',
            'Apply the profile, shortlist, SOP, and document feedback properly.',
            'Show real implementation if you still feel the session did not deliver value.',
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'top_badge_text' => 'Zero fluff. Real strategy. Clear accountability.',
            'section_badge_text' => "Here's the Guarantee",
            'heading_line1' => 'Serious guidance.',
            'heading_line2' => 'Serious accountability.',
            'description' => "We don't believe in empty promises. We believe in honest strategy, practical feedback, and real implementation. If you fully apply the session guidance and still feel it delivered no value, we review your case fairly.",
            'guarantee_points' => self::defaultGuaranteePoints(),
            'principle_label' => 'Simple Principle',
            'principle_title' => 'This only works if you execute.',
            'principle_description' => 'That is why implementation matters as much as the advice itself.',
            'seal_badge_text' => 'GMC Guarantee',
            'seal_value_text' => '100%',
            'seal_footer_text' => 'Value-Driven Strategy Commitment',
            'is_active' => true,
        ];
    }
}
