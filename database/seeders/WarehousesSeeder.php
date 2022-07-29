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
            'country' => 'Mexico',
            'state' => 'San Luis Potosí',
            'city' => 'San Luis Potosí',
            'neighborhood' => 'Parque Logistik II',
            'street' => 'Dubai',
            'ext_number' => '112',
            'zipcode' => '79526',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3699.6615390955412!2d-100.87022748451106!3d21.985949459786713!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842abf3c4cde1c4b%3A0x6d5afd3c9c778be5!2sChronos%20Almacenaje!5e0!3m2!1ses-419!2smx!4v1658328130828!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);

        Warehouse::create([
            'name' => 'Heavy Duty',
            'slug' => 'heavy-duty',
            'country' => 'Mexico',
            'state' => 'San Luis Potosí',
            'city' => 'San Luis Potosí',
            'neighborhood' => 'Parque Logistik II',
            'street' => 'Europa',
            'ext_number' => '405',
            'zipcode' => '79526',
            'map' => '<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3699.9971407333733!2d-100.88061126978933!3d21.973072813862462!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842abb3b85bc43a5%3A0x1fe8dfffd721c31a!2sChronos%20Heavy%20Duty!5e0!3m2!1ses-419!2smx!4v1658328600506!5m2!1ses-419!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>',
        ]);
    }
}
