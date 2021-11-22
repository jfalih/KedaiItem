<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Convertation extends Model
{
    use HasFactory;
    protected $fillable = [
        'from_id', 'to_id'
    ];
    /**
     * Get the user associated with the Convertation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function sender()
    {
        return $this->belongsTo(User::class, 'from_id');
    }
    /**
     * Get the receiver associated with the Convertation
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function receiver()
    {
        return $this->belongsTo(User::class, 'to_id');
    }
    public function messages()
    {
        return $this->hasMany(Message::class);
    }
}
