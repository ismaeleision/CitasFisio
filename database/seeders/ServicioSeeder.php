<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class ServicioSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        DB::table("servicios")->insert(['servicios' => 'Cuello', 'imagen' => $faker->imageUrl(640, 480, 'products')]);
        DB::table("servicios")->insert(['servicios' => 'Trapecios', 'imagen' => $faker->imageUrl(640, 480, 'products')]);
        DB::table("servicios")->insert(['servicios' => 'Espalda', 'imagen' => $faker->imageUrl(640, 480, 'products')]);
    }
}
