<?php

namespace App\Models;

use Database\Factories\PostFactory;
use Illuminate\Database\Eloquent\Attributes\Scope;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Auth;

class Post extends Model
{
    /** @use HasFactory<PostFactory> */
    use HasFactory;

    protected $fillable = [
        'post_type_id',
        'user_id',
        'title',
        'content',
    ];

    /**
     * Load what the post card shows: author, type, counters and whether the current user liked it.
     *
     * @param  Builder<Post>  $query
     */
    #[Scope]
    protected function withCardData(Builder $query): void
    {
        $query->with(['user', 'postType'])
            ->withCount(['comments', 'likes']);

        if (Auth::check()) {
            $query->withExists(['likes as liked' => fn (Builder $likes) => $likes->whereKey(Auth::id())]);
        }
    }

    /**
     * @return HasMany<Comment, $this>
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * @return BelongsToMany<User, $this>
     */
    public function likes(): BelongsToMany
    {
        // dislikes are stored in the same table, they must not be counted as likes
        return $this->belongsToMany(User::class, 'likes')->wherePivot('is_dislike', 0)->withPivot('is_dislike')->withTimestamps();
    }

    /**
     * @return BelongsTo<PostType, $this>
     */
    public function postType(): BelongsTo
    {
        return $this->belongsTo(PostType::class);
    }

    /**
     * @return BelongsTo<User, $this>
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
