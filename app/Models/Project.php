<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    public const STATUSES = [
        'ongoing' => 'Ongoing',
        'upcoming' => 'Upcoming',
        'completed' => 'Handed Over',
        'ready' => 'Ready',
    ];

    protected $fillable = [
        'name', 'slug', 'tagline', 'location', 'description', 'status', 'is_featured',
        'is_active', 'nature', 'floors', 'land_area', 'facing', 'total_apartments',
        'total_lifts', 'apartment_types', 'features', 'ground_floor', 'handover_year',
        'hero_image', 'cover_image', 'location_image', 'brochure_file', 'sort_order',
    ];

    protected function casts(): array
    {
        return [
            'is_featured' => 'boolean',
            'is_active' => 'boolean',
            'apartment_types' => 'array',
            'features' => 'array',
            'total_apartments' => 'integer',
            'total_lifts' => 'integer',
        ];
    }

    protected static function booted(): void
    {
        static::saving(function (Project $project) {
            if (blank($project->slug)) {
                $project->slug = Str::slug($project->name);
            }
        });
    }

    public function getRouteKeyName(): string
    {
        return 'slug';
    }

    public function images()
    {
        return $this->hasMany(ProjectImage::class)->orderBy('sort_order');
    }

    public function floorPlans()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'floor_plan')->orderBy('sort_order');
    }

    public function gallery()
    {
        return $this->hasMany(ProjectImage::class)->where('type', 'gallery')->orderBy('sort_order');
    }

    public function testimonials()
    {
        return $this->hasMany(Testimonial::class);
    }

    public function contactMessages()
    {
        return $this->hasMany(ContactMessage::class);
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    public function getHeroImageUrlAttribute(): string
    {
        return asset($this->hero_image ?: 'uploads/placeholder.jpg');
    }

    public function getCoverImageUrlAttribute(): string
    {
        return asset($this->cover_image ?: ($this->hero_image ?: 'uploads/placeholder.jpg'));
    }

    public function getStatusLabelAttribute(): string
    {
        return self::STATUSES[$this->status] ?? Str::title($this->status);
    }

    public function getStatusClassAttribute(): string
    {
        return match ($this->status) {
            'completed' => 'bg-gold-500/15 text-gold-700 ring-gold-500/30',
            'upcoming' => 'bg-accent-500/10 text-accent-600 ring-accent-500/25',
            'ready' => 'bg-brand-600 text-white ring-brand-600/40',
            default => 'bg-brand-500/10 text-brand-700 ring-brand-500/25',
        };
    }

    public function getSpecSummaryAttribute(): string
    {
        $types = collect($this->apartment_types ?? []);

        if ($types->isEmpty()) {
            return $this->nature ?? 'Residential';
        }

        $sizes = $types->pluck('size')->filter()->values();

        return $sizes->isEmpty()
            ? 'Luxury Apartments'
            : 'Apartments '.$sizes->first().' – '.$sizes->last();
    }
}
