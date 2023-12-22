<?php

namespace App\Models;

use App\Models\Artist;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable = [
        "artist_id",
	    "balance"
    ];

    public function resolveRouteBinding($value, $field = null)
     {
         try {
             return parent::resolveRouteBinding(Crypt::decrypt($value), $field);
         } catch (DecryptException $error){

         }
     }

    public function artist()
    {
        return $this->hasOne(Artist::class, "id","artist_id");
    }
}