<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    use HasFactory;

    protected $fillable = [
        'message', 'from_id', 'to_id', 'convertation_id'
    ];
    /**
     * Get the user that owns the Message
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function from()
    {
        return $this->belongsTo(User::class, 'from_id', 'id');
    }
    public function conversation()
    {
        return $this->belongsTo(Convertation::class,'convertation_id','id');
    }
}
