<?php

use App\Models\ShippingService;
use App\Models\Warehouse;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('shipping_services_per_warehouses', function (Blueprint $table) {
            $table->id();
            $table->string('_resource_state')->index();
            $table->foreignIdFor(ShippingService::class)->constrained()->cascadeOnDelete();
            $table->foreignIdFor(Warehouse::class)->constrained()->cascadeOnDelete();
            $table->enum('state', ['STAGE', 'PRODUCTION'])->default('STAGE');
            $table->enum('services', ['COD', 'REGULAR', 'BOTH']);
            $table->string('file_extension');
            $table->json('endpoints');
            $table->json('credentials');
            $table->timestamp('active')->default(now());
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('shipping_services_per_warehouses');
    }
};
