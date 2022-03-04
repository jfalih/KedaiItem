<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymentcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'code', 'img_id','status_id', 'fee_admin'
    ];
    public function topups()
    {
        return $this->hasMany(Topup::class, 'method_id', 'id');
    }
    public function payments()
    {
        return $this->hasMany(Payment::class, 'method_id', 'id');
    }
    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'img_id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
}
