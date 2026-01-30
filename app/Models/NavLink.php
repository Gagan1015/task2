<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class NavLink extends Model
{
    protected $fillable = [
        'label',
        'url',
        'target',
        'parent_id',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(NavLink::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(NavLink::class, 'parent_id')->orderBy('sort_order');
    }

    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order');
    }

    public function scopeTopLevel($query)
    {
        return $query->whereNull('parent_id');
    }

    /**
     * Get navigation tree
     */
    public static function getTree()
    {
        return static::active()
            ->topLevel()
            ->ordered()
            ->with(['children' => function ($query) {
                $query->active()->ordered();
            }])
            ->get();
    }
}
