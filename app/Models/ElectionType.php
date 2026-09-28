<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ElectionType extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'icon',
        'color',
        'description',
        'setup_minutes',
        'difficulty',
        'default_positions',
        'is_featured',
        'status',
        'approved',
        'usage_count',
        'sort_order',
    ];

    protected $casts = [
        'default_positions' => 'array',
        'is_featured' => 'boolean',
        'setup_minutes' => 'integer',
    ];

    public function category()
    {
        return $this->belongsTo(ElectionCategory::class);
    }

    public function elections()
    {
        return $this->hasMany(Election::class);
    }
}