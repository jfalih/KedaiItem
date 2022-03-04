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
            'name' => 'Jan Falih Fadhillah',
            'atas_nama' => 'Jan Falih Fadhillah',
            'nomor_rekening' => 120120120,
            'username' => 'janfalih',
            'balance' => 0,
            'point' => 0,
            'email' => 'bosspulsa57@gmail.com',
            'password' => Hash::make('password'),
            'nomorhp' => rand(20000,200000),
            'status_id' => Status::first()->id,  
            'profile_id' => 1,
        ]);
        $user->roles()->attach([1,2,3]);
    }
}
