<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShippingService extends Model
{
    use Uuid;
    use HasFactory;

    protected $fillable = [
        'name',
        'email',
        'contact',
        'phone',
        'credentials',
        'image',
    ];
}
