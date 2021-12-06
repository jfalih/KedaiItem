<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\{User, Status, Item};
class ItemSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = Str::random(10);
        $item = Item::create([
            'name' => $name,
            'stok'=>1,
            'min'=>1,
            'slug'=> Str::slug($name,'-'),
            'description' => Str::random(10), 
            'price' => rand(2000,2000000),
            'user_id' => User::first()->id,  
            'status_id' => Status::first()->id
        ]);
        $item->images()->attach([1]);
        $item->subcategories()->attach([1]);
    }
}
