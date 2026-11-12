<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProjectImage extends Model
{
    protected $fillable = ['project_id', 'image', 'caption', 'type', 'sort_order'];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function getImageUrlAttribute(): string
    {
        return $this->image ? asset($this->image) : asset('uploads/placeholder.jpg');
    }
}
