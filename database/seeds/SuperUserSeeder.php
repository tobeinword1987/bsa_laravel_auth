<?php

use Illuminate\Database\Seeder;
use App\User;

class SuperUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(array('firstname' => 'admin', 'lastname' => 'admin', 'password'=> bcrypt('admin'),'email' => 'admin@admin.com','role' => 'admin'));
    }
}
