<?php

namespace App\Models;

use App\Models\City;
use App\Models\User;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use App\Models\Wallet;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Artist extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'biography',
        'city_id'
    ];

     /** @route resolve binding with encryption key */
     public function resolveRouteBinding($value, $field = null)
     {
         try {
             return parent::resolveRouteBinding(Crypt::decrypt($value), $field);
         } catch (DecryptException $error){

         }
     }

     /**
      * Get the user that owns the Artist
      *
      * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
      */
     public function user()
     {
         return $this->belongsTo(User::class, 'user_id', 'id');
     }

     /**
      * Get the city associated with the Artist
      *
      * @return \Illuminate\Database\Eloquent\Relations\HasOne
      */
     public function city()
     {
         return $this->hasOne(City::class, 'id', 'city_id');
     }

    // relationship with artis and Wallet

    public function wallet()
    {
        return $this->belongsTo(Wallet::class, "artist_id","id");
    }

    public function followers()
    {
        return $this->belongsToMany(Follower::class);
    }

    public function eventAndTour()
    {
        return $this->belongsTo(EventAndTour::class);
    }
}
