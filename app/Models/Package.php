<?php

namespace App\Models;

use App\Enum\PackageStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Package extends Model
{
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected $casts = [
        'status' => PackageStatusEnum::class
    ];
}
