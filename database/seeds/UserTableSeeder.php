<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run user database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create(['email'   => 'admin@admin.com',
                      'password'=> 'admin123',
                      'name'    => 'administrator',
                      'surname' => '',
                      'role'    => 1]);
    }
}
