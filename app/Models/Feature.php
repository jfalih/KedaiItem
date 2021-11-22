<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Feature extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'img_id', 'description'
    ];

    public function image()
    {
        return $this->hasOne(Image::class, 'id', 'img_id');
    }
}
