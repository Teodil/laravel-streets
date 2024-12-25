<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public function region(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Region::class, 'region_id', 'id');
    }

    public function streets(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Street::class, 'city_id', 'id');
    }

}
