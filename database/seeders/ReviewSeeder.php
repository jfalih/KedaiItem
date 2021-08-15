<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\{User, Item};
class ReviewSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('reviews')->insert([
            'comment' => 'Halooooo',
            'rating' => rand(0,4),
            'user_id' => User::first()->id,
            'item_id' => Item::first()->id
        ]);
    }
}
