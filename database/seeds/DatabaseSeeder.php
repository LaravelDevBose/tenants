<?php

use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'=>'Admin',
            'username'=>'tenant_admin',
            'email'=>'admin@admin.com',
            'password'=>Hash::make('123456'),
            'image'=> asset('assets/images/user.png')
        ]);
    }
}
