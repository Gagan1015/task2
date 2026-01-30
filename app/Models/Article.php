<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class Article extends Model
{
    protected $fillable = [
        'title',
        'slug',
        'excerpt',
        'content',
        'image',
        'category',
        'author_id',
        'views',
        'is_featured',
        'is_active',
        'published_at',
    ];

    protected $casts = [
        'is_featured' => 'boolean',
        'is_active' => 'boolean',
        'views' => 'integer',
        'published_at' => 'datetime',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($article) {
            if (empty($article->slug)) {
                $article->slug = Str::slug($article->title);
            }
        });
    }

    public function author(): BelongsTo
    {
        return $this->belongsTo(User::class, 'author_id');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopePublished($query)
    {
        return $query->where('is_active', true)
                     ->whereNotNull('published_at')
                     ->where('published_at', '<=', now());
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get formatted views count
     */
    public function getFormattedViewsAttribute()
    {
        if ($this->views >= 1000) {
            return number_format($this->views / 1000, 1) . 'k';
        }
        return (string) $this->views;
    }

    /**
     * Get relative published date
     */
    public function getRelativeDateAttribute()
    {
        return $this->published_at ? $this->published_at->diffForHumans() : null;
    }
}
