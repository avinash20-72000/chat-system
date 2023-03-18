<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class adminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'  =>  'avinash',
            'email'  =>  'avinash@gmail.com',
            'password'  =>  Hash::make('password'),
            'is_active'  =>  1,
            'is_admin'  =>  1,
            'image'  =>  null,
        ]);
    }
}
