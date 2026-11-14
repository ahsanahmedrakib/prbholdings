<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class TeamMember extends Model
{
    public const CATEGORIES = [
        'management' => 'Management Team',
        'dream' => 'Dream Team',
        'operations' => 'Operations Team',
    ];

    protected $fillable = [
        'name', 'designation', 'category', 'bio', 'image',
        'email', 'phone', 'linkedin', 'is_active', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_active' => 'boolean',
        ];
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function getImageUrlAttribute(): ?string
    {
        return $this->image ? asset($this->image) : null;
    }

    public function getInitialsAttribute(): string
    {
        return collect(explode(' ', $this->name))
            ->filter()
            ->take(2)
            ->map(fn ($part) => Str::upper(Str::substr($part, 0, 1)))
            ->implode('');
    }

    public function getCategoryLabelAttribute(): string
    {
        return self::CATEGORIES[$this->category] ?? Str::title($this->category);
    }
}
