<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Contracts\Encryption\DecryptException;

class EventAndTour extends Model
{
    use HasFactory;

    protected $fillable = [
        "artist_id",
        "event_cover_photo",
        "venue",
        "event_tour_date",
        "event_date",
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
