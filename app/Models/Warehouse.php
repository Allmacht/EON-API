<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        'slug',
        'name',
        'country',
        'state',
        'city',
        'neighborhood',
        'street',
        'ext_number',
        'int_number',
        'zipcode',
        'phone',
    ];
}
