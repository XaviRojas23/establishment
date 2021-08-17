<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            'name' => 'Restaurant',
            'slug' => Str::slug('Restaurant') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Café',
            'slug' => Str::slug('Café') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Hotel',
            'slug' => Str::slug('Hotel') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Hospital',
            'slug' => Str::slug('Hospital') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Pub',
            'slug' => Str::slug('Pub') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Gym',
            'slug' => Str::slug('Gym') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
        DB::table('categories')->insert([
            'name' => 'Cinema',
            'slug' => Str::slug('Cinema') ,
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now()
        ]);
    }
}
