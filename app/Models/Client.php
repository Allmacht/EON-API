<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        '_resource_state',
        'slug',
        'name',
        'business_name',
        'country',
        'state',
        'city',
        'neighborhood',
        'street',
        'ext_number',
        'int_number',
        'zipcode',
        'phone',
        'service_phone',
        'rfc',
        'rfe',
        'idc',
        'immex',
        'ssn',
        'email',
        'email_notification',
        'contact_name',
        'notification_concept',
        'logo',
        'rfid',
        'user_id',
    ];
}
