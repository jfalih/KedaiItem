<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'method', 'options', 'total', 'user_id','references'
    ];
    /**
     * The purchases that belong to the Payment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function purchases()
    {
        return $this->belongsToMany(Purchase::class,'purchase_payment','payment_id','purchase_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
