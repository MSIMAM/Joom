<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class Follower extends Model
{
    use HasFactory;


    protected $fillable = [
        "user_id",
	    "artist_id"
    ];

    public function resolveRouteBinding($value, $field = null)
     {
         try {
             return parent::resolveRouteBinding(Crypt::decrypt($value), $field);
         } catch (DecryptException $error){

         }
     }
    
    public function user(){
        return $this->hasOne(User::class, "id","user_id");
    }

    public function artist()
    {
        return $this->hasOne(Artist::class, "id","artist_id");
    }
}
