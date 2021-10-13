<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug','description','sold','views','price','status_id','user_id' 
    ];
    /**
     * Get all of the reviews for the Item
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
    public function subcategories()
    {
        return $this->belongsToMany(Subcategory::class,'subcategory_item', 'sub_id', 'item_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function getPriceFormatAttribute()
    {
        return 'Rp'.number_format($this->price,2,',','.');
    }
    public function getCountReview($number = null)
    {
        return  ($number == null) ?  $this->reviews->count() : $this->reviews()->where('rating', $number)->count();
    }
    public function getPercentage($number)
    {
        return ($this->getCountReview() == 0) ? 0 : $this->getCountReview($number) / $this->getCountReview() * 100; 
    }
    public function getAverageRatingAttribute()
    {
        return $this->reviews->avg('rating');
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
