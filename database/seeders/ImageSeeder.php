<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{Status, Image, User};
class ImageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $image = Image::create([
            'name' => '/img/marketplace/single/01.jpg',
            'caption' => Str::random(10), 
            'status_id' => Status::first()->id
        ]);
        $image->users()->attach([1]);
    }
}
