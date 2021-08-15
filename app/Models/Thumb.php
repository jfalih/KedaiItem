<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Thumb extends Model
{
    use HasFactory;
    /**
     * The reviews that belong to the Thumb
     *
     * @return \Illuminate\Reviews\Eloquent\Relations\BelongsToMany
     */
    public function reviews(): BelongsToMany
    {
        return $this->belongsToMany(Reviews::class);
    }
}
