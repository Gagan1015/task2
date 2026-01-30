<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    protected $fillable = [
        'name',
        'price',
        'image',
        'category',
        'tag',
        'is_upcoming',
        'is_featured',
        'listing_type',
        'specs',
        'year',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_upcoming' => 'boolean',
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'specs' => 'array',
        'sort_order' => 'integer',
        'year' => 'integer',
    ];

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeByListingType($query, $type)
    {
        return $query->where('listing_type', $type);
    }

    public function scopeByCategory($query, $category)
    {
        return $query->where('category', $category);
    }

    public function scopeMostSeen($query)
    {
        return $query->where('listing_type', 'most_seen');
    }

    public function scopeElectric($query)
    {
        return $query->where('listing_type', 'electric');
    }

    public function scopeUpcoming($query)
    {
        return $query->where('listing_type', 'upcoming');
    }

    public function scopeUsed($query)
    {
        return $query->where('listing_type', 'used');
    }
}
