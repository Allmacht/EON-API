<?php

use App\Models\Client;
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
        Schema::create('clients_per_warehouses', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->foreignIdFor(Warehouse::class)->constrained()->nullOnDelete();
            $table->foreignIdFor(Client::class)->constrained()->cascadeOnDelete();

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients_per_warehouses');
    }
};
