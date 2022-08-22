<?php

use App\Models\User;
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
        Schema::create('clients', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->string('_resource_state')->index();
            $table->string('slug')->unique();
            $table->string('name')->index();
            $table->string('business_name');
            $table->string('country');
            $table->string('state');
            $table->string('city');
            $table->string('neighborhood');
            $table->string('street');
            $table->integer('ext_number');
            $table->string('int_number')->nullable();
            $table->integer('zipcode');
            $table->string('phone');
            $table->string('service_phone')->nullable();
            $table->string('rfe')->nullable();
            $table->string('idc')->nullable();
            $table->string('immex')->nullable();
            $table->string('ssn')->nullable();
            $table->string('email');
            $table->string('email_notification')->nullable();
            $table->string('contact_name')->nullable();
            $table->string('notification_concept')->nullable();
            $table->string('logo')->nullable();
            $table->boolean('rfid')->default(false);
            $table->string('access_token')->nullable();
            $table->enum('services', ['COD', 'REGULAR', 'BOTH'])->nullable();
            $table->foreignIdFor(User::class)->nullable()->constrained()->nullOnDelete();

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
        Schema::dropIfExists('clients');
    }
};
