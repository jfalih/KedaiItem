<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Topup extends Model
{
    use HasFactory;
        
    protected $fillable = [
        'nominal', 'method_id', 'references', 'kode_unik','user_id','status'
    ];

    public function paymentcategory()
    {
        return $this->belongsTo(Paymentcategory::class,'method_id');
    }
}
