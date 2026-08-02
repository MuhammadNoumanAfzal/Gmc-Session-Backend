<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StrategyRibbonSection extends Model
{
    protected $fillable = [
        'page_key',
        'front_ribbon_items',
        'back_ribbon_items',
        'is_active',
    ];

    protected $casts = [
        'front_ribbon_items' => 'array',
        'back_ribbon_items' => 'array',
        'is_active' => 'boolean',
    ];

    public const HOME_PAGE_KEY = 'home';

    public static function defaultFrontRibbonItems(): array
    {
        return [
            'GMC Scholarship Strategy',
            'Application Clarity',
            'Admissions Growth',
            'Profile Strength',
        ];
    }

    public static function defaultBackRibbonItems(): array
    {
        return [
            'Scholarship Positioning',
            'SOP Direction',
            'Trust Building',
            'Application Strategy',
        ];
    }

    public static function defaultAttributes(): array
    {
        return [
            'page_key' => self::HOME_PAGE_KEY,
            'front_ribbon_items' => self::defaultFrontRibbonItems(),
            'back_ribbon_items' => self::defaultBackRibbonItems(),
            'is_active' => true,
        ];
    }
}
