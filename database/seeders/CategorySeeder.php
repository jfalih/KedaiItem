<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use App\Models\Status;
class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $name = Str::random(10);
        DB::table('categories')->insert([
            'name' => $name,
            'img_id'=> 1,
            'slug'=> Str::slug($name,'-'),
            'status_id' => Status::first()->id
        ]);
    }
}
