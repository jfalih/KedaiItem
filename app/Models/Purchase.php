<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    protected $fillable = [
        'quantity', 'user_id', 'item_id','options','gusername','catatan'
    ];
    public function item(){
        return $this->belongsTo(Item::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    /**
     * The payments the Purchase
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function payments(){
        return $this->belongsToMany(Payment::class,'purchase_payment','purchase_id','payment_id');
    }
}
