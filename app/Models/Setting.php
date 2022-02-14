<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'logo_id', 'favicon_id', 'title', 'description','harga','maintenance'
    ];
    
    public function logo()
    {
        return $this->hasOne(Image::class, 'id', 'logo_id');
    }
    public function favicon()
    {
        return $this->hasOne(Image::class, 'id', 'favicon_id');
    }
}
