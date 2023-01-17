<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'username' => 'Mahmoud',
            "email" => "mahmoud@gmail.com",
            'phone' => '1224344555454545',
            'password' => bcrypt('122345678')
        ]);
    }
}
