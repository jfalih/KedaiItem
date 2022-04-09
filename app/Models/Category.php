<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'status_id','img_id'
    ];
    /**
     * The subcategories that belong to the Category
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class,'subcategory_category');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
