<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Subcategory;
use App\Models\Status;
class SubcategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = Str::random(10);
        $sub = Subcategory::create([
            'name' => $name,
            'slug'=> Str::slug($name,'-'),
            'status_id' => Status::first()->id
        ]);
        $sub->categories()->attach([1]);
    }
}
