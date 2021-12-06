<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use App\Models\{Image, Status, User, Role};
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => Str::random(10),
            'username' => Str::random(8),
            'status_id' => Status::first()->id,  
            'profile_id' => 1,
            'nomorhp' => rand(20000,200000),
            'email' => Str::random(10).'@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $user->roles()->attach([1]);
    }
}
