<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Warehouse;
use App\Models\WarehousesPerUser;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $warehouses = Warehouse::all();

        $user = User::create([
            'name' => 'Ulises Jacob CR',
            'email' => 'ulises.jacob.cr@gmail.com',
            'password' => 'admin',
            'warehouse_id' => $warehouses[0]->id,
        ]);

        WarehousesPerUser::create([
            'user_id' => $user->id,
            'warehouse_id' => $warehouses[0]->id,
        ]);

        WarehousesPerUser::create([
            'user_id' => $user->id,
            'warehouse_id' => $warehouses[1]->id,
        ]);

        $user->assignRole('super-admin');
    }
}
