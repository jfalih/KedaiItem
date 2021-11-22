<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Subcategory extends Model
{
    use HasFactory;
    protected $fillable = [
        'name', 'status_id', 'slug'
    ];
    /**
     * Get the category that owns the Subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    /**
     * The categories that belong to the Subcategory
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class,'subcategory_category');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function items()
    {
        return $this->belongsToMany(Item::class,'subcategory_item','item_id','sub_id');
    }
}
