<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;
    /**
     * The thumbs that belong to the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    protected $fillable = [
        'rating', 'comment', 'user_id', 'item_id'
    ];
    public function thumbs(): BelongsToMany
    {
        return $this->belongsToMany(Thumb::class);
    }
    /**
     * Get the user that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    /**
     * The replies that belong to the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function replies(): BelongsToMany
    {
        return $this->belongsToMany(Review::class, 'reply_review', 'review_id', 'reply_id');
    }

    /**
     * Get the item that owns the Review
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function item(): BelongsTo
    {
        return $this->belongsTo(Item::class);
    }
}
