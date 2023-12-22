<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfilePassportPath extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'profile_url'
    ];


    /**
     * Get the user that owns the ProfilePassportPath
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
