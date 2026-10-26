<?php

namespace App\Models;

use Database\Factories\PostTypeFactory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PostType extends Model
{
    /** @use HasFactory<PostTypeFactory> */
    use HasFactory;

    protected $fillable = [
        'name',
    ];

    /**
     * Each type gets its own color: [badge classes, dot classes].
     */
    private const PALETTE = [
        ['bg-amber-50 text-amber-700 ring-amber-600/20', 'bg-amber-500'],
        ['bg-sky-50 text-sky-700 ring-sky-600/20', 'bg-sky-500'],
        ['bg-emerald-50 text-emerald-700 ring-emerald-600/20', 'bg-emerald-500'],
        ['bg-rose-50 text-rose-700 ring-rose-600/20', 'bg-rose-500'],
        ['bg-violet-50 text-violet-700 ring-violet-600/20', 'bg-violet-500'],
        ['bg-teal-50 text-teal-700 ring-teal-600/20', 'bg-teal-500'],
    ];

    /**
     * Tailwind classes of the type badge.
     */
    public function badgeClasses(): string
    {
        return self::PALETTE[($this->id - 1) % count(self::PALETTE)][0];
    }

    /**
     * Tailwind classes of the small colored dot next to the type name.
     */
    public function dotClasses(): string
    {
        return self::PALETTE[($this->id - 1) % count(self::PALETTE)][1];
    }

    /**
     * @return HasMany<Post, $this>
     */
    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }
}
