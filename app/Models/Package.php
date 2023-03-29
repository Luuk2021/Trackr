<?php

namespace App\Models;

use App\Enum\PackageStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Package extends Model
{
    use HasFactory;

    protected $guarded = ['id'];
    protected $fillable = ['email', 'firstname', 'lastname', 'streetname', 'housenumber', 'zipcode', 'city'];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function shop(): BelongsTo
    {
        return $this->belongsTo(Shop::class);
    }

    protected $casts = [
        'status' => PackageStatusEnum::class
    ];
}
