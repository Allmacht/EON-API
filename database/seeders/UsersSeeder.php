<?php

namespace Database\Seeders;

use App\Models\User;
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
        $user = User::create([
            'name' => 'Ulises Jacob CR',
            'email' => 'ulises.jacob.cr@gmail.com',
            'password' => 'admin',
        ]);

        $user->assignRole('super-admin');
    }
}
