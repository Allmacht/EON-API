<?php

namespace Database\Seeders;

use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class WarehousesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Warehouse::create([
            'name' => 'CHRONOS',
            'slug' => 'chronos',
            'country' => 'México',
            'state' => 'San Luis Potosí',
            'city' => 'San Luis Potosí',
            'neighborhood' => 'Parque Logistik II',
            'street' => 'Dubai',
            'ext_number' => '112',
            'zipcode' => '79526',
        ]);

        Warehouse::create([
            'name' => 'Heavy duty',
            'slug' => 'heavy-duty',
            'country' => 'México',
            'state' => 'San Luis Potosí',
            'city' => 'San Luis Potosí',
            'neighborhood' => 'Parque Logistik II',
            'street' => 'Europa',
            'ext_number' => '405',
            'zipcode' => '79526',
        ]);
    }
}
