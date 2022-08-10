<?php

namespace App\Models;

use App\Traits\Uuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ShippingServicesPerWarehouse extends Model
{
    use HasFactory, Uuid;

    protected $fillable = [
        '_resource_state',
        'shipping_service_id',
        'warehouse_id',
        'state',
        'services',
        'file_extension',
        'endpoints',
        'credentials',
        'active',
    ];

    protected $with = ['ShippingService'];

    public function warehouse(): BelongsTo
    {
        return $this->belongsTo(Warehouse::class);
    }

    public function ShippingService(): BelongsTo
    {
        return $this->belongsTo(ShippingService::class);
    }
}
