<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class Shop extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['name', 'streetname', 'housenumber', 'zipcode', 'city'];

    public function packages(): HasMany
    {
        return $this->hasMany(Package::class);
    }

    public function recipients(): HasManyThrough
    {
        return $this->hasManyThrough(User::class, Package::class);
    }

    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
