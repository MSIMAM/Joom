<?php

namespace App\Models;

use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Genre extends Model
{
    use HasFactory;

    protected $fillable = [
        'genre_name'
    ];

    /** @route resolve binding with encryption key */
    public function resolveRouteBinding($value, $field = null)
    {
        try {
            return parent::resolveRouteBinding(Crypt::decrypt($value), $field);
        } catch (DecryptException $error){

        }
    }
}
