<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class User extends Authenticatable implements MustVerifyEmail
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'username',
        'nomorhp',
        'status_id',
        'profile_id',
        'open',
        'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    /**
     * The roles that belong to the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function roles()
    {
        return $this->belongsToMany(Role::class);
    }
    public function getRoleNameAttribute()
    {
        $level = [];
        foreach($this->roles as $role){
            array_push($level, $role->name);
        }
        return $level;
    }
    public function getSoldAttribute()
    {
        $sold = 0;
        foreach($this->items as $item){
            $sold += $item->sold;
        }
        return $sold;
    }
    public function getPendapatanAttribute(){
        $pendapatan = 0;
        foreach($this->items as $item){
            foreach($item->purchases as $purchase){
                $pendapatan += $purchase->quantity * $item->price;
            }
        }
        return $pendapatan;
    }
    /**
     * Get all of the reviews for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function images()
    {
        return $this->belongsToMany(Image::class);
    }
    /**
     * Get the profile associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function profile()
    {
        return $this->hasOne(Image::class, 'id', 'profile_id');
    }
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
    public function messages()
    {
        return $this->hasMany(Message::class, 'from_id', 'id');
    }
    public function conversations()
    {
        return $this->hasMany(Conversation::class, 'from_id', 'id');
    }
    /**
     * Get all of the items for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function items()
    {
        return $this->hasMany(Item::class);
    }
    public function pembelian()
    {
        return $this->hasMany(Purchase::class);
    }
    public function status()
    {
        return $this->belongsTo(Status::class);
    }
    public function ktp()
    {
        return $this->belongsTo(Image::class,'ktp_id', 'id');
    }
    public function tabungan()
    {
        return $this->belongsTo(Image::class,'tabungan_id', 'id');
    }
    /**
     * Get the user associated with the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasOne
     */
    public function upgrade()
    {
        return $this->hasOne(Upgrade::class, 'user_id', 'id');
    }
    /**
     * Get all of the comments for the User
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function payments()
    {
        return $this->hasMany(Payment::class);
    }
    public function selfie()
    {
        return $this->belongsTo(Image::class,'selfie_id', 'id');
    }
}